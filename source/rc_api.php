<?php
include 'session_check.php';
include 'config.php';

$report = $_GET['report_button'];
$data = array(
    'token' => $_SESSION['token'],
    'content' => 'report',
    'format' => 'json',
    'report_id' => $report
);


$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$GLOBALS['api_url']);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE); // set to true for production use
curl_setopt($ch,CURLOPT_VERBOSE,0);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch,CURLOPT_AUTOREFERER,true);
curl_setopt($ch,CURLOPT_MAXREDIRS,10);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($ch,CURLOPT_FRESH_CONNECT,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data,'','&'));



$output = curl_exec($ch);
// create command
$command = "CREATE TABLE `$type_database`( 
    `datatype_id` bigint(99) PRIMARY KEY  AUTO_INCREMENT,
    `study_id` bigint(99) NOT NULL,
    `varname` varchar(99) NOT NULL,
    `varlabel` varchar(99) DEFAULT NULL,
    `vartype` varchar(20) NOT NULL,
    `values` varchar(99) DEFAULT NULL)
    ENGINE=MyISAM DEFAULT CHARSET=utf8;";



$message = "";

// check if lu_datatype table is exist
$exists = mysqli_query($conn,"select * from $type_database");

if(!$exists){
    //check if table is created successfully
    $query_create_table = mysqli_query($conn,$command);

    if($query_create_table){
        $message .= "Table created successfully\n";
    }
    else{
        $message .= "Failed to create table\n";
        echo "$message";
        exit();
    }
}


$command_insert = "";
// Get redcap data and create a table to insert its datatype
$array = json_decode($output,true);
// varname hashset
$check_var = array();
foreach($array as $key => $val) {
    if(is_array($val)){
        foreach($val as $key2=> $val2){
            // Check if varname is already exist
            if(!array_key_exists($key2, $check_var)){
                $check_var[$key2] = 1;
                $type = gettype($val2);
                // insert
                $command_insert = "INSERT INTO `$type_database`(`study_id`,`varname`,`varlabel`,`vartype`,`values`)
                                    VALUES ('1','$key2','$val2','$type','$val2');";
                $query_insert_type = mysqli_query($conn,$command_insert);
                
                // Check any insertion error
                if (!$query_insert_type) {
                    die('Invalid query: ' . mysqli_error($conn));
                }
            }
        }
    }
 
}

$message .=" Insert successfully";

if($message != "") echo "$message";
curl_close($ch);
exit();

?>



