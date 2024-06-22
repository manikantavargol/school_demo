<?php
include 'functions.php';

$error = '';
$classes = fetch_all_classes();

// Add class
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_class'])) {
    $name = $_POST['name'];
    
    if (!$name) {
        $error = 'Class name is required';
    } else {
        $sql = "INSERT INTO classes (name, created_at) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        header('Location: classes.php');
        exit();
    }
}

// Delete class
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_class'])) {
    $class_id = $_POST['class_id'];
    $sql = "DELETE FROM classes WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    header('Location: classes.php');
    exit();
}

// Fetch all classes again after potential update
$classes = fetch_all_classes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Classes</h1>
        <form action="classes.php" method="post" class="mb-5">
            <div class="form-group">
                <label for="name">Add New Class</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary" name="add_class">Add Class</button>
        </form>
        
        <h2>Existing Classes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?= $class['name'] ?></td>
                    <td><?= $class['created_at'] ?></td>
                    <td>
                        <form action="classes.php" method="post" class="d-inline">
                            <input type="hidden" name="class_id" value="<?= $class['class_id'] ?>">
                            <button type="submit" class="btn btn-danger" name="delete_class">Delete</button>
                        </form>
                        <!-- Edit functionality can be added similarly -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
