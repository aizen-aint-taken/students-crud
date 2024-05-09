<?php

include("./config.php");

if(isset($_GET["id"])){
    $delete_id = $_GET["id"];

    // echo $delete_id;

    $delete = "DELETE FROM `enrollees` WHERE student_id = '$delete_id' ";

    if($mysqli->query($delete) === TRUE) {
        header("Location: navbar.php");
        exit();
    }else{
        echo "error deleting data" . $mysqli->error;
    }
}