<?php
include 'functions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$student = fetch_student($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">View Student</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $student['name'] ?></h5>
                <p class="card-text">Email: <?= $student['email'] ?></p>
                <p class="card-text">Address: <?= $student['address'] ?></p>
                <p class="card-text">Class: <?= $student['class_name'] ?></p>
                <p class="card-text">Created At: <?= $student['created_at'] ?></p>
                <img src="<?= $student['image'] ?>" alt="image" class="img-thumbnail">
                <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
