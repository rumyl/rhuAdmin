<?php
require_once 'config/master.php'; 

if(isset($_GET['appointment_date'])) {

    $return = '';
    $appointment_date = $_GET['appointment_date'];
    $timestamp = strtotime($appointment_date);
    
    $formattedDate = date('Y-m-d', $timestamp);
    
    $sql = "SELECT appointment_time FROM tbl_appointment WHERE appointment_date ='$formattedDate'";
    $records = $crud->read($sql);
    
    $options = array(
        "08:00 AM - 08:20 AM",
        "08:20 AM - 08:40 AM",
        "08:40 AM - 09:00 AM",
        "09:00 AM - 09:20 AM",
        "09:20 AM - 09:40 AM",
        "09:40 AM - 10:00 AM",
        "10:00 AM - 10:20 AM",
        "10:20 AM - 10:40 AM",
        "10:40 AM - 11:00 AM",
        "11:00 AM - 11:20 AM",
        "11:20 AM - 11:40 AM",
        "11:40 AM - 12:00 NN",
        "01:00 PM - 01:20 PM",
        "01:20 PM - 01:40 PM",
        "01:40 PM - 02:00 PM",
        "02:00 PM - 02:20 PM",
        "02:20 PM - 02:40 PM",
        "02:40 PM - 03:00 PM",
        "03:00 PM - 03:20 PM",
        "03:20 PM - 03:40 PM",
        "03:40 PM - 04:00 PM",
        "04:00 PM - 04:20 PM",
        "04:20 PM - 04:40 PM",
        "04:40 PM - 05:00 PM"
    );
    
    if ($records !== false) {
        foreach ($records as $record) {
            $recordTime = $record['appointment_time'];
            $options = array_diff($options, [$recordTime]);
        }
    }
    
    $return = '<option>Please Select Time</option>';
    foreach ($options as $option) {
        $return .= '<option>' . $option . '</option>';
    }

    echo json_encode($return);		
}				
?>