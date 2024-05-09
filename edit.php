<?php

include("./config.php");
session_start();
if(isset($_GET["id"])){
    $edit_id = $_GET["id"];

    // echo $edit_id;

    $sql = $mysqli->query("SELECT * FROM `enrollees` 
                           WHERE student_id  = '$edit_id'");
    $student = $sql->fetch_assoc();

    if(isset($_POST["submit"])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $sql = $mysqli->query("UPDATE `enrollees` SET 
        `username`='$username',
        `email`='$email',
        `password`='$password' 
        WHERE `student_id` = $edit_id");   

        header("Location: navbar.php");
        session_destroy();
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing User</title>
    <link rel="stylesheet" href="bstrap.css">
    <style>
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 300px;
}  


form{
    border: 1px solid #ccc; 
    padding: 15px; 
    border-radius: 8px;
}
    </style>
</head>
<body>
<form action="edit.php?id=<?= $edit_id?>" method="post">
<div class="container" style="width: 300px; margin: 0 auto;">
  <form action="index.php" method="post">
    <div class="mb-2">
      <label>Username</label>
      <input type="text" name="username" value="<?= $student["username"]?>" class="form-control" style="width: 100%;">
    </div>
    <div class="mb-2">
      <label>Email</label>
      <input type="email" name="email" value="<?= $student["email"]?>" class="form-control" style="width: 100%;">
    </div>
    <div class="mb-2">
      <label>Password</label>
      <input id="mypass" type="password" value="<?= $student["password"]?>" name="password" class="form-control" style="width: 100%;">
      <input type="checkbox" onclick="myPassword()">Show Password
    </div>
    <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
  </form>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

