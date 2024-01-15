<?php
require_once 'config/master.php';

if(isset($_GET['id'])) {


                $id = $_GET['id'];

                $dataToUpdate = array(
                    'status'  => 'denied'
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
