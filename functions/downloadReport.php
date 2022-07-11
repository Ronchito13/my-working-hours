<?php

require('../download/fpdf.php');

$currentDateTime = date('Y-m-d');
$user_name = 'Full Name: ' . $_GET['user_name'];
$reportDate = 'Report for: ' . $_GET['the_month'] . "/" .$_GET['the_year'];
$company_name = 'Company Name: ' . $_GET['company_name'];
$hours_of_work = "Total hours of work: " . $_GET['hours_of_work'];
$hours_i_did = "Total hours you did: " . $_GET['hours_i_did'];
$hours_missing = "Hours missing to complete full month: " . $_GET['hours_missing'];
$how_many_days_i_worked = "How many days you worked: " . $_GET['how_many_days_i_worked'];
$free_days_i_have = "Free days I have in total: " . $_GET['free_days_i_have'];
$free_days_i_did = "Free days I used this month: " . $_GET['free_days_i_did'];
$sick_days_i_have = "Sick days I have in total: " . $_GET['sick_days_i_have'];
$sick_days_i_did = "Sick days I used this month: " . $_GET['sick_days_i_did'];

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);


// Top Vars
$pdf->Cell(100,10,$currentDateTime,0,1,'L');
$pdf->Cell(100,10,$user_name,0,1,'L');
$pdf->Cell(100,10,$company_name,0,1,'L');
$pdf->Cell(100,10,$reportDate,0,1,'L');


// space 

$pdf->Cell(50,10,"",0,1,'L');

// Table

$pdf->Cell(150,10,$hours_of_work,0,1,'L');
$pdf->Cell(150,10,$hours_i_did,0,1,'L');
$pdf->Cell(150,10,$hours_missing,0,1,'L');
$pdf->Cell(150,10,$how_many_days_i_worked,0,1,'L');
$pdf->Cell(150,10,$free_days_i_have,0,1,'L');
$pdf->Cell(150,10,$free_days_i_did,0,1,'L');
$pdf->Cell(150,10,$sick_days_i_have,0,1,'L');
$pdf->Cell(150,10,$sick_days_i_did,0,1,'L');





$pdf->Output();









 