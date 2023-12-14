<?php
session_start();
require_once 'config/master.php';

if(isset($_GET['id'])) {

    $result = 0;
    $tableName = 'tbl_appointment';
    $id = $_GET['id'];

    $dataToUpdate = array(
        'findings'           => $_GET['diagnosis'],
        'treatment'          => $_GET['treatment'],
        'doctor_id'          => $_SESSION['user_id'],
        'status'             => "Served"
    );
    
    $condition = "id = '{$id}'";

    $updateId = $crud->update($tableName, $condition, $dataToUpdate);
    if($updateId){
                
        $result = $id;
    }

    echo $result;
}

?>
