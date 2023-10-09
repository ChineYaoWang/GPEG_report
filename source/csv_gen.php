<?php 
include 'session_check.php';
require_once "config.php";

$col = ['username','email','fname','lname','status','type','type_id'];
$jsondata = select_col($conn,$user_table,$col);

// Decode json data and convert it
// into an associative array
$jsonans = json_decode($jsondata, true);

// CSV file name => geeks.csv
$csv = 'report/report.csv';
   
// File pointer in writable mode
$file_pointer = fopen($csv, 'w');
   
// Traverse through the associative
// array using for each loop
$header = false;
foreach($jsonans as $i){ 
    if (empty($header))
    {
        $header = array_keys($i);
        fputcsv($file_pointer, $header);
        $header = array_flip($header);
    }
    fputcsv($file_pointer, array_merge($header, $i));
}
   
// Close the file pointer.
fclose($file_pointer);


// Download csv report to client
$url = 'location:report/report.csv';
  
  
// Use basename() function to return the base name of file
$file_name = basename($url); 
  
$info = pathinfo($file_name);
  
// Checking if the file is a CSV file or not
if ($info["extension"] == "csv") {
    header($url);
} 
  
else echo "Sorry, that's not a CSV file";
   
exit(); 
?>