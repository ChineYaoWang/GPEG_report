<?php
require_once "config.php";
    session_start();
    if(empty($_SESSION['user_name'])) {
        header('location:login.php');
        exit();
    }
    if((time() - $_SESSION['last_time_login']) > 6000){
        $command = "DROP TABLE `$type_database`;";
        $query = mysqli_query($conn,$command);
        header('location:logout.php');
    }
?>