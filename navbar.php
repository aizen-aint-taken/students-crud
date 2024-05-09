<?php

include("./config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

   
    $mysqli->query("INSERT INTO `enrollees` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')");

  
    $insertion_order = $mysqli->query("SELECT MAX(`student_id`) FROM `enrollees`")->fetch_row()[0] + 1;
    $mysqli->query("UPDATE `enrollees` SET `insertion_order` = $insertion_order WHERE `username` = '$username'");
}


$sql = $mysqli->query("SELECT * FROM `enrollees` ORDER BY `student_id` LIMIT 10 ");
$students = $sql->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
         body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #343a40 !important;
        }
        .navbar-brand {
            color: #fff !important;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
        }
        .table {
            background-color: #fff;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
        }
        .btn-add {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-add:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
</head>
<body>
  <form action="" method="post">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand">Enrollees</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Status</a>
                    </li>
                    
                </ul>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student): ?>
                            <tr>
                                <td><?= $student["student_id"]?></td>
                                <td><?= $student["username"]?></td>
                                <td><?= $student["email"]?></td>
                                <td><?= $student["password"]?></td>
                                <td><a href="edit.php?id=<?= $student["student_id"]?>">Edit</a></td>
                                <td><a href="delete.php?id=<?= $student["student_id"]?>">Delete</a></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-add"><a href="index.php" style="color: inherit; text-decoration: none;">Add User</a></button>
            </div>
        </div>
    </div>
  </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
