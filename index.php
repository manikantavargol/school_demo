<?php
include 'functions.php';
$students = fetch_all_students();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Students</h1>
        <a href="create.php" class="btn btn-primary mb-3">Add Student</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['email'] ?></td>
                    <td><?= $student['class_name'] ?></td>
                    <td><img src="<?= $student['image'] ?>" alt="image" width="50"></td>
                    <td>
                        <a href="view.php?id=<?= $student['id'] ?>" class="btn btn-info">View</a>
                        <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
