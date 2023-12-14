<?php
require_once 'config/master.php';

if(isset($_GET['query'])) {

                $query = $_GET['query'];

                $sql = "SELECT * FROM tbl_patients WHERE (lname LIKE '%$query%' OR fname LIKE '%$query%' OR mname LIKE '%$query%') AND status = '1' ORDER BY lname ASC LIMIT 50";

                $records = $crud->read($sql);
                $results = "";

                if ($records !== false) {

                foreach($records as $record) {
                    $patient_id = $record['patient_id'];
                    $name = $record['lname']. ", ". $record['fname']. " ".$record['mname'];
                    $dob        = $record['dob'];
                    $age = $crud->calculateAge($dob);

                    $results .= '<tr class="btn_choose"  data-pid ='.$patient_id.'>
                                    <td style="text-align:left;">'.$name.'</td>
                                </tr>';
                  }
                }
                echo ($results);
}

?>
