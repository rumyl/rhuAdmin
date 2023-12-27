<?php
session_start();
require_once('tcpdf/tcpdf.php');
require_once 'config/master.php'; 

$check = !empty($_SESSION["user_id"]);

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_appointment INNER JOIN tbl_patients ON tbl_appointment.patient_id = tbl_patients.patient_id INNER JOIN tbl_users ON tbl_appointment.doctor_id = tbl_users.user_id WHERE tbl_appointment.id = '$id' ORDER BY tbl_appointment.id ASC";

$info   = $crud->getSingleRow($sql);

$name   = $info['lname'].", ".$info['fname']." ".$info['mname'];
$dob    = $info['dob'];
$age    = $crud->calculateAge($dob);
$date   = $info['appointment_date'];

$d2words = date("F j, Y", strtotime($date));
$address = $info['address'];

// Findings and Treatment
$findings   = $info['findings'];
$treatment  = $info['treatment'];
$doctor     = $info['fullname'];

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('Medical Prescription');
$pdf->SetAuthor('Medical Prescription');
$pdf->SetTitle('Medical Prescription');

// Set password protection for the PDF (optional)

$date = new DateTime($dob );

// Format the date as MMDDYY
$formattedDate = $date->format('mdy');
if ($check) {

} else {
    $password = $formattedDate;
    $pdf->SetProtection(array('print', 'copy'), $password);

}

// set default header data
//customize header
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// add Page
$pdf->AddPage('P', array(139.7, 216));

// code start here

$pdf->SetFont('helvetica', 'B', 14); 
// Add text with red color
$pdf->Cell(0, 5, 'Patient Information Management', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 12   ); 
$pdf->Cell(0, 5, '123 Anywhere St. Any City, ST 12345', 0, 1, 'C');


$pdf->SetFont('helvetica', '', 14); 
// Add text with red color
$pdf->Cell(0, 15, 'PRESCRIPTION', 0, 1, 'C');


$pdf->SetFont('helvetica', '', 10   ); 


// Calculate column widths based on percentages
$leftColumnWidth = $pdf->getPageWidth() * 0.60;
$rightColumnWidth = $pdf->getPageWidth() * 0.40;


$pdf->Cell($leftColumnWidth, 5, 'Name: ' . $name, 0, 0);
$pdf->Cell(0, 5, 'Date: ' . $d2words, 0, 1);

$pdf->Cell($leftColumnWidth, 5, 'Address: ' . $address, 0, 0);
$pdf->Cell(0, 5, 'Age: ' . $age, 0, 1);

$pdf->Ln(3); 

//findings
$pdf->SetFont('helvetica', 'B', 11); 
$pdf->Cell(0, 10, 'DIAGNOSIS', 0, 1, 'L');
//findings data
$pdf->SetFont('helvetica', '', 11); 
$pdf->MultiCell(0, 50, $findings, 1, 'L', 0, 0, '', '', true);


$pdf->Ln(50); 


$findings = 'Patient has symptoms of XYZ.';

//treatment
$pdf->SetFont('helvetica', 'B', 11); 
$pdf->Cell(0, 10, 'TREATMENT', 0, 1, 'L');

//treatment data
$pdf->SetFont('helvetica', '', 11); 
$pdf->MultiCell(0, 50, $treatment, 1, 'L', 0, 0, '', '', true);

//added line
$pdf->Ln(60);

$pdf->SetDrawColor(0, 0, 0); // Reset border color to black
$pdf->SetLineWidth(0.2); // Reset border width

$pdf->Cell(0, 10, 'Prescribed by: ' . $doctor, 0, 1);


$pdf->Output('Medical Prescription.pdf', 'I');
?>
