<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/fuse1.0/core/init.php';

$link = "";
	
if ($_GET["what"] == "residents") {
	$xls_filename = 'Residents_'.date('Y-m-d').'.csv'; 
	$link = "upload.php";
    
	
	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// Start of printing column names as names of MySQL fields
	$cols = array();
	$cols[0] = "Last Name";
	$cols[1] = "First Name";
	$cols[2] = "Middle Name";
	$cols[3] = "Date of Birth";
	$cols[4] = "Sex";
	$cols[5] = "Civil Status";
	$cols[6] = "Sitio";
	$cols[7] = "4P's";

	// output the column headings
	fputcsv($output, $cols);

}


?>
