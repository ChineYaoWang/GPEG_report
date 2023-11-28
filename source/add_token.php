<?php
include 'session_check.php';
require_once "config.php";

$project_name = $_POST['project_button'];
$study_name = $_POST['study_button'];
$user_name = $_SESSION['user_name'];
$token = $_POST['token'];

$sql = "INSERT INTO `$token_table` (`token_id`,`user_id`,`study_id`,`project_id`,`redcap_token`) 
VALUES (2,
        (SELECT user_id FROM `$user_table` WHERE username = '$user_name'),
        (SELECT study_id FROM `$study_table` WHERE studyname = '$study_name'),
        (SELECT project_id FROM `$project_table` WHERE projectname = '$project_name'),
        '$token')";

    $query=mysqli_query($conn,$sql);
    $message ="";
    if($query){
        $message ="Success !";
    }
    else{
        $message = $conn->error;
    }

    // $json_message = json_encode($message);
    echo $json_message;
    ?>