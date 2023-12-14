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


                    $results .= '<tr>
                                    <td style="text-align:left;">'.$name.'</td>
                                    <td style="text-align:left;">'.$record['gender'].'</td>
                                    <td style="text-align:center;">'.$age.'</td>
                                    <td style="text-align:center;">'.$crud->dateToWords($record['dob']).'</td>
                                    <td style="text-align:center;">'. $record['email']." / ".$record['contact'].'</td>
                                    <td>
                                    <button class="btn btn-warning btn-editPatient"  data-pid ='.$patient_id.'>Modify</button> |
                                    <a href="patients?patient_id=' . $patient_id . '&action=remove" onclick="return confirm(\'Are you sure you want to remove this patient?\');"><button class="btn btn-danger">Remove</button></a></td>
                                </tr>';
                  }
                }
                echo $results;
}

?>
