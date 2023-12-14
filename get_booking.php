<?php
require_once 'config/master.php'; 

if (isset($_GET['start'])) {
    $start = $_GET['start'];
    $formattedStart = date('Y-m-d H:i:s', strtotime($start));
    
    // Add error handling for the SQL query
    $sql = "SELECT * FROM tbl_online WHERE appointment_date >= '$formattedStart' AND status = 'booked'";
    $records = $crud->read($sql);

    if ($records === false) {
        // Handle the case where the SQL query fails
        echo json_encode(array('error' => 'Failed to retrieve records.'));
    } else {
        // Proceed with processing the records
        $events = array();
        foreach ($records as $row) {

            $dateString = $row['appointment_date'];
            $timeString = $row['appointment_time'];
           // Split the time range into start and end times
            list($startTime, $endTime) = explode(' - ', $timeString);

            // Combine date and start time strings
            $dateTimeStartString = $dateString . ' ' . $startTime;

            // Convert to datetime for the start time
            $dateTimeStart = date('Y-m-d H:i:s', strtotime($dateTimeStartString));

            $name = $row['lname'] . ", " . $row['fname'] . " " . $row['mname'];
            $events[] = array(
                'id' => $row['id'],
                'title' => $name,
                'start' => $dateTimeStart,
                'end' => $dateTimeStart,
                'backgroundColor' => "#00c0ef",
                'borderColor' => "#00c0ef",
                'allDay' => false
            );
        }

        echo json_encode($events);
    }
}
			
?>