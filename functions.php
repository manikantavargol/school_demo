<?php
include 'db.php';

// Fetch all students with class names
function fetch_all_students() {
    global $conn;
    $sql = "SELECT student.*, classes.name AS class_name FROM student 
            LEFT JOIN classes ON student.class_id = classes.class_id";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch all classes
function fetch_all_classes() {
    global $conn;
    $sql = "SELECT * FROM classes";
    $result = $conn->query($sql);
    if ($result === false) {
        // Handle query error
        die('Error: ' . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch single student
function fetch_student($id) {
    global $conn;
    $sql = "SELECT student.*, classes.name AS class_name FROM student 
            LEFT JOIN classes ON student.class_id = classes.class_id 
            WHERE student.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Fetch single class
function fetch_class($class_id) {
    global $conn;
    $sql = "SELECT * FROM classes WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Upload image
function upload_image($file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return false;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        $target_file = $target_dir . time() . '_' . basename($file["name"]);
    }
    
    // Check file size
    if ($file["size"] > 500000) {
        return false;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return false;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}
?>
