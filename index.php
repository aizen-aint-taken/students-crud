<?php

include("./config.php");

session_start();

if(isset($_POST["submit"])) {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Validate username
    if(empty($username)) {
        echo "Username cannot be empty.";
    } elseif(strlen($username) < 6) {
        echo "Username must be at least 6 characters long.";
    }

    // Validate password
    elseif(empty($password)) {
        echo "Password cannot be empty.";
    } elseif(strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
    }

    // Validate email
    elseif(empty($email)) {
        echo "Email cannot be empty.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        // If all validations pass, proceed with insertion
        $sql = "INSERT INTO `enrollees` (`student_id`, `username`, `email`, `password`) 
        VALUES (NULL, '$username', '$email', '$password')";

        if($mysqli->query($sql) === TRUE) {
            header("Location: navbar.php");
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="bstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="password.js"></script>
    <link rel="stylesheet" href="bstrap.css">
</head>
<body>
<div class="container" style="width: 300px; margin: 0 auto;">
  <form action="index.php" method="post">
    <div class="mb-2">
      <label>Username</label>
      <input type="text" name="username" class="form-control" style="width: 100%;">
    </div>
    <div class="mb-2">
      <label>Email</label>
      <input type="email" name="email" class="form-control" style="width: 100%;">
    </div>
    <div class="mb-2">
      <label>Password</label>
      <input id="mypass" type="password" name="password" class="form-control" style="width: 100%;">
      <input type="checkbox" onclick="myPassword()">Show Password
    </div>
    <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
  </form>
</div>
</body>
</html>