<?php 
include 'session_check.php';
require_once "config.php";
require('fpdf/fpdf.php');

$col = ['username','fname','lname','status','type','type_id'];
$jsondata = select_col($conn,$user_table,$col);

// Decode json data and convert it
// into an associative array
$jsonans = json_decode($jsondata, true);
echo $jsonans;
// CSV file name => geeks.csv
    
ob_end_clean();

  
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
  
// // Set the font for the text
// $pdf->SetFont('Arial', 'B', 18);
  
// // // Prints a cell with given text 
// $pdf->Cell(60,20,'Report');


$header = false;
foreach($jsonans as $row){ 
    if (empty($header))
    {   
        $header = array_keys($row);
        foreach($header as $column_heading){
            $pdf->SetFont('Arial','B',12);	
		    $pdf->Cell(30,12,$column_heading,1);
        }
    }
    $pdf->ln();
    foreach($row as $columnValue){
        $pdf->SetFont('Arial','',8);	
		$pdf->Cell(30,12,$columnValue,1);	
    }
}
  
// return the generated output
$pdf->Output();
$conn->close();
?>
