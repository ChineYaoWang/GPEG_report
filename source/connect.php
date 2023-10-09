<?php
include 'session_check.php';
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_register"])) {

    // collect value of input field
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
  
    $status = $_POST['status'];
    $type = $_POST['type'];
    $type_id = Get_typeID($type);
    
    // Create the new password hash
    $hash = password_hash($password, PASSWORD_DEFAULT);


    // Check if email and username exist
    $check=[];
    if(isEmailExists($conn,$user_table,$email)){
        $check["Error"] = "Email address is already existed\n";
    }
    if(isUserNameExists($conn,$user_table,$user_name)){
        $check["Error"] .= " User name is already existed\n";
    }
    
    // if no error
    if(!count($check)):
        $sql = "INSERT INTO `$user_table` (`username`,`password`,`email`,`fname`,`lname`,`status`,`type`,`type_id`) 
                            VALUES ('$user_name','$hash','$email','$fname','$lname','$status','$type','$type_id')";

        
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=home.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    endif;

    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message');window.location.href='add_user.php';</script>";
    $conn->close();
}
else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_register"])) {

    // collect value of input field
    $user_name = $_POST['usr'];
    // Check if target user is chosen
    $check=[];
    if($user_name == '--Please select username--'){
        $check["Error"].= "Please select user\n";
    }
    // Check modified config or password
    if(strlen($_POST['password']) !=0){
        $password = $_POST['password'];
        // Check if password is empty
        if(isEmpty($password)){
            $check["Error"].= "Password cannot be empty\n";
        }
        // Create the new password hash
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE  `$user_table`  SET `password` = '$hash'
        WHERE `username` = '$user_name' ";

    }
    else{
        $status = $_POST['status'];
        $type = $_POST['type'];
        // Check if status and type are selected
        if($status == '--Please choose status--'){
            $check["Error"].= "Please choose status\n";
        }
        if($type == '--Please choose a type--'){
            $check["Error"].= "Please choose a type\n";
        }
        $type_id = Get_typeID($type);
        $sql = "UPDATE  `$user_table`  SET `status` = '$status',`type`='$type',`type_id` = '$type_id'
        WHERE `username` = '$user_name' ";
    }
    // if no error
    if(!count($check)){
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_user.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    }


    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message');window.location.href='add_user.php';</script>";
    $conn->close();
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_study"])) {
    $study_id = $_POST['study_id'];
    $studyname = $_POST['study_name'];
    
    
    $check=[];
    // Check empty input
    if(isEmpty($studyname)){
        $check["Error"].="Study name cannot be empty\n";
    }
    if(isEmpty($study_id)){
        $check["Error"].="Study id cannot be empty\n";
    }
    // Check if study name exist
    if(isStudyNameExists($conn,$study_table,$studyname)){
        $check["Error"] .= "Study name is already existed\n";
    }
    // if no error
    if(!count($check)):
        $sql = "INSERT INTO `$study_table` (`study_id`,`studyname`) 
                            VALUES ('$study_id','$studyname')";

        
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_study.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    endif;
    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message');window.location.href='add_study.php'; </script>";
    $conn->close();
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_study"])) {
    $old_studyname =$_POST['old_name'];
    $studyname = $_POST['study_name'];
    $check=[];
    // Check empty input
    if($old_studyname == '--Choose study--'){
        $check["Error"].="Please select a study\n";
    }
    if(isEmpty($studyname)){
        $check["Error"].="Study name cannot be empty\n";
    }
    // check if new studyname exists
    if(isStudyNameExists($conn,$study_table,$studyname)){
        $check["Error"] .= "Study name is already existed";
    }
    // if no error
    if(!count($check)):
        $sql = "UPDATE  `$study_table`  SET `studyname` = '$studyname'
                            WHERE `studyname` = '$old_studyname' ";
        $query = mysqli_query($conn,$sql);
        echo $conn->error;
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_study.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    endif;
    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message');window.location.href='add_study.php';</script>";
    $conn->close();
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_project"])) {
    $project_id = $_POST['project_id'];
    $study_name = $_POST['study_name'];
    $project_name = $_POST['project_name'];
    $check=[];

    // check if empty
    if($study_name == '--Choose study--'){
        $check["Error"] .= "Study name cannot be empty\n";
    }
    if(isEmpty($project_name)){
        $check["Error"] .= "Project name cannot be empty\n";
    }

    // Get study_id
    $sql = "select `study_id` from `$study_table` WHERE studyname = '$study_name' ";
    $query = mysqli_query($conn,$sql);
    $study_id = "";
    
    if($query){
        while($row = $query->fetch_row()){
            $study_id =  $row[0];
        }
    }
    else{
        echo "$conn->error\n";
    }

    // Check if study, project name exist
    if(isProjectNameExists($conn,$project_table,$project_name)){
        $check["Error"] .= "Project name is already existed\n";
    }
    // if no error
    if(!count($check)):
        $sql = "INSERT INTO `$project_table` (`project_id`,`study_id`,`projectname`) 
                            VALUES ('$project_id','$study_id','$project_name')";

        
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_project.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    endif;
    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message'); window.location.href='add_project.php';</script>";
    $conn->close();
}
else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_project"])) {
    // collect value of input field
    $projectname = $_POST['projectname'];
    $check=[];
    $sql="";
    //check if project is select
    if($projectname == "--Choose Project--"){
        $check["Error"] .= "--Please Choose Project--\n";
    }
    // update studyname or projectname
    if($_POST['studyname'] != '--Please select studyname--\n'){
        $studyname = $_POST['studyname'];
        $sql = "UPDATE 
                `tbl_projects`
                SET 
                ".$project_table.".study_id = (SELECT `study_id` FROM `tbl_studies` WHERE ".$study_table.".studyname ='$studyname' )
                WHERE 
                projectname = '$projectname';";

    }
    else{
        $new_projectname = $_POST['new_projectname'];
        if(isEmpty($new_projectname)){
            $check["Error"] .= "Project name cannot be empty";
        }
        if(isProjectNameExists($conn,$project_table,$new_projectname)){
            $check["Error"] .= "Project name is already existed";
        }

        $sql = "UPDATE  `$project_table`  SET `projectname` = '$new_projectname'
        WHERE `projectname` = '$projectname' ";
        
    }
    // if no error
    if(!count($check)){
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_project.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    }

    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message');window.location.href='add_project.php';</script>";
    $conn->close();
}
else if(isset($_GET["get_token_btn"])) {
    $project_name = $_GET['project_button'];
    $study_name = $_GET['study_button'];
    $user_name = $_SESSION['user_name'];
    $sql = "SELECT  `redcap_token` from `$token_table`
        INNER JOIN `$project_table` ON ".$project_table.".project_id = ".$token_table.".project_id
        INNER JOIN `$study_table` ON ".$study_table.".study_id = ".$token_table.".study_id
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
            if(!$check) $message = "Not Found\n";
            
        }
        else{
            $message = $conn->error;
        }
    
        $json_message = json_encode($message);
        echo $json_message;
}
else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_report"])) {
    $report_id = $_POST['report_name_id'];;
    $studyname = $_POST['study_button'];
    $projectname = $_POST['project_button'];
    $reportname = $_POST['report_name'];

    $study_id = Get_studyid($conn,$study_table,$studyname);
    $project_id = Get_projectid($conn,$project_table,$projectname);
    // Check if report name exist
    $check=[];
    if(isReportIDExists($conn,$report_table,$report_id)){
        $check["Error"] .= "Report ID is already existed\n";
    }
    
    if(!count($check)):
        $sql = "INSERT INTO `$report_table` (`report_id`,`study_id`,`project_id`,`reportname`) 
                            VALUES ('$report_id','$study_id','$project_id','$reportname')";

        
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_report.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    endif;

    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message'); window.location.href='add_report.php';</script>";
    $conn->close();
    
}
else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_report"])) {
    $reportname = $_POST['report_name_r'];
    $report_id = $_POST['new_report_id'];
    $check=[];
    $sql = "";

    // check if user did select report
    if($reportname == '--Please select reportname--'){
        $check["Error"] .= "Please select report\n";
    }
    if($_POST['study'] != '--Select New Study--'){
        // Reset study and project
        $studyname = $_POST['study'];
        $projectname = $_POST['project'];
        // check project is selected or not
        if($projectname == '--Select New Project--'){
            $check["Error"] .= "Please select project\n";
        }
        $study_id = Get_studyid($conn,$study_table,$studyname);
        $project_id = Get_projectid($conn,$project_table,$projectname);
        $sql .= "UPDATE 
                `$report_table`
                SET 
                `study_id` = '$study_id',
                `project_id` = '$project_id'
                WHERE 
                `reportname` = '$reportname';";
    }
    else{
        // Reset report name
        $new_report_name = $_POST['new_report_name'];
        // Check if report name exist
        if(isReportIDExists($conn,$report_table,$report_id)){
            $check["Error"] .= "New Report ID is already existed\n";
        }     
        //check white space or empty
        else if(!isEmpty($new_report_name) && !isEmpty($rc_id)){
            $sql = "UPDATE  `$report_table`  SET `reportname` = '$new_report_name',`report_id` = '$r'
            WHERE `reportname` = '$reportname' ";
        }
        else{
            $check["Error"] .= "Report name or ID cannot be empty or space\n";
        }
    }
    
    if(!count($check)):
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "Success, The page will be redirected in 1 seconds\n";
            header('Refresh: 1; URL=add_report.php');
            exit();
        }
        else{
            echo "$conn->error\n";
        }
    endif;
  

    // Show error
    $message = json_encode($check);
    echo "<script type='text/javascript'>alert('$message'); window.location.href='add_report.php';</script>";
    $conn->close();
    
}
//filter the content based on the chosen record_id
else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["record_id"])){
    $select=[];
    $selected_id;
    // echo "Header: ";
    // Iterate through form fields
    foreach ($_POST as $fieldName => $fieldValue) {
        // Check if the field name matches a pattern (e.g., "fieldX")
        if($fieldName=='record_id')  $selected_id = $fieldValue;
        $select[$fieldName] = array($fieldValue);
        // echo $fieldName," ",$fieldValue," ";
    }
    $result["Header"] = $select;
    // echo "<br>";
    // echo "<br>";
    $result;
    $rpt_content = $_SESSION['all_content'];
    if($_SESSION['study'] == "Stress&Well-Being"){
        $result = array_merge($result,RPT_SW($rpt_content,$selected_id));
    }
    echo json_encode($result);
}
// fectch all the content based on chosen study and project
else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["rpt_content"])){
    $result = [];
    // Iterate through all contents ($_SESSION['content'] is initialized in fetch_token.php)
    foreach ($_SESSION['content'] as $contentName => $contentID) {
        $result[$contentName] = rc_api_content($_SESSION['token'],$contentID);
    }
    $_SESSION['all_content'] = $result;
}
?>