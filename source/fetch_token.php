<?php
include 'session_check.php';
require_once "config.php";

$project_name = $_GET['project_button'];
$study_name = $_GET['study_button'];
$user_name = $_SESSION['user_name'];
$sql = "SELECT  `redcap_token` from `$token_table`
    INNER JOIN `$project_table` ON ".$project_table.".project_id = ".$token_table.".project_id
    INNER JOIN `$study_table` ON ".$study_table.".study_id = ".$token_table.".study_id AND ".$study_table.".study_id = ".$project_table.".study_id
    INNER JOIN `$user_table` ON ".$user_table.".user_id = ".$token_table.".user_id
    WHERE studyname = '$study_name' AND projectname = '$project_name' AND username = '$user_name' ";

    $query=mysqli_query($conn,$sql);
    $message ="";
    if($query){
        $check = false;
        while($row = $query->fetch_row()){
            $check = true;
            $message = $row[0];
        }
        
        if(!$check) $message = "Token not found";
        else{
            // store token 
            $_SESSION['token'] = $message;
            // Get all the report ID
            $sql2 = "SELECT `report_id`,`reportname` from `$report_table` 
                    INNER JOIN `$project_table` ON ".$project_table.".project_id = ".$report_table.".project_id
                    INNER JOIN `$study_table` ON ".$study_table.".study_id = ".$report_table.".study_id AND ".$study_table.".study_id = ".$project_table.".study_id
                    WHERE studyname = '$study_name' AND projectname = '$project_name'";
            $result = mysqli_query($conn, $sql2);
            // Check if the query was successful
            $content = [];
            if ($result) {
                // Fetch each row from the result and add it to the array
                while ($row = $result->fetch_row()) {
                    if($row[1] == 'RPT_header'){
                        $header_id = $row[0];
                    }
                    else{
                        $content[$row[1]] = $row[0];
                    }
                    
                }
                // Store the report_id of RPT_Header in the session variable
                $_SESSION['id'] = $header_id;
                // Store the report_id of content in the session variable
                $_SESSION['content'] = $content;
                // store project
                $_SESSION['project'] = $project_name;
                // store study
                $_SESSION['study'] =$study_name;
                // Free the result set
                mysqli_free_result($result);
            } 
        }
    }
    else{
        $message = $conn->error;
    }
    // $json_message = json_encode($message);
    $json_message = json_encode($message);
    echo $json_message;
    ?>