<?php
require_once "config.php";
    session_start();
    // Check if login
    if(empty($_SESSION['user_name'])) {
        header('location:login.php');
        exit();
    }
    // Check if time out
    if((time() - $_SESSION['last_time_login']) > 6000){
        $command = "DROP TABLE `$type_database`;";
        $query = mysqli_query($conn,$command);
        header('location:logout.php');
    }
?>