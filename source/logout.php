<?php
include "config.php";

$command = "DROP TABLE `$type_database`;";
$query = mysqli_query($conn,$command);
session_start();
session_unset();
header('location:login.php')

?>