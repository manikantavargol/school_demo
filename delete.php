<?php
include 'functions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$student = fetch_student($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete the image
    if (file_exists($student['image'])) {
        unlink($student['image']);
    }
    
    $sql = "DELETE FROM student WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Delete Student</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $student['name'] ?></h5>
                <p class="card-text">Email: <?= $student['email'] ?></p>
                <p class="card-text">Address: <?= $student['address'] ?></p>
                <p class="card-text">Class: <?= $student['class_name'] ?></p>
                <p class="card-text">Created At: <?= $student['created_at'] ?></p>
                <img src="<?= $student['image'] ?>" alt="image" class="img-thumbnail">
                <form action="delete.php?id=<?= $student['id'] ?>" method="post" class="mt-3">
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
