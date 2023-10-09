<?php
include "config.php";

// SQL Statement
$sql = "SELECT `projectname`,`studyname` FROM ".$project_table." INNER JOIN ".$study_table." ON ".$project_table.".study_id = ".$study_table.".study_id  ";
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