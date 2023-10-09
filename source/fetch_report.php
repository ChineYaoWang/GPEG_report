<?php
include "config.php";
$project_name = $_GET['projectname'];
$study_name = $_GET['studyname'];
// SQL Statement
$sql = "SELECT `reportname` FROM ".$report_table." 
INNER JOIN ".$study_table." ON ".$study_table.".study_id = ".$report_table.".study_id  
INNER JOIN ".$project_table." ON ".$project_table.".project_id = ".$report_table.".project_id  AND ".$study_table.".study_id = ".$project_table.".study_id 
WHERE studyname = '$study_name' AND projectname = '$project_name'
ORDER BY reportname";
//Process the query
$query=mysqli_query($conn,$sql);
$data = array();
while($rows = $query->fetch_row())
{
    $data[] = $rows;
}
$json_data = json_encode($data);
echo $json_data;

?>