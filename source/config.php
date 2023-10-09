<?php
$servername = "localhost";
$username_db = "wowjw";
$password_db = "zzz111!";
//$data_base = "guest_db";
$data_base = "gpeg_rs";
$user_table = "tbl_users";
$study_table = "tbl_studies";
$project_table = "tbl_projects";
$token_table = "tbl_tokens";
$report_table = "tbl_report";
//$GLOBALS['api_token'] = "E51F42D2A0F214E8152E31349648C2C3";
$GLOBALS['api_token'] = "0261ECC8D4AFA2A124AEB150233E47BC";
$GLOBALS['api_url'] = "https://rc-1.nyspi.org/api/";
$type_database= "redcap_report_data";


$conn = new mysqli($servername, $username_db, $password_db, $data_base);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require_once "functions.php";

?>