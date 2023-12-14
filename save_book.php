<?php
require_once 'config/master.php';

if(isset($_GET['id'])) {


                $id = $_GET['id'];

                $dataToUpdate = array(
                    'status'  => 'booked'
                );

                $tableName = 'tbl_online';
                $condition = "id = '{$id}'";
                $updateId = $crud->update($tableName, $condition, $dataToUpdate);
                
                $sql = "SELECT * FROM tbl_online WHERE id ='$id'";
                $get = $crud->getSingleRow($sql);
                $time = $get['appointment_time'];
                $date = $get['appointment_date'];

                $dataToInsert1 = array(
                'lname'   => strtoupper($get['lname']),
                'fname'   => strtoupper($get['fname']),
                'mname'   => strtoupper($get['mname']),
                'gender'  => strtoupper($get['gender']),
                'dob'     => $get['dob'],
                'address' => "",
                'contact' => "",
                'email'   => $get['email'],
                'status'  => 1
                );

                

                $inserted1 = $crud->create('tbl_patients', $dataToInsert1);

                $dataToInsert2 = array(
                    'patient_id'         => $inserted1,
                    'doctor_id'          => 0,
                    'findings'           => "",
                    'treatment'          => "",
                    'staff_id'           => 0,
                    'appointment_date'  => $date,
                    'appointment_time'  => $time,
                    'type'               => "online",
                    'status'             => "Pending"
                );

                $inserted2 = $crud->create('tbl_appointment', $dataToInsert2);

                $events = array();
                $events[] = array(
                    'name'  => $get['fname'],
                    'email' => $get['email'],
                    'time'  => $time,
                    'date'  => $date
                );

            echo json_encode($events);
}

?>
