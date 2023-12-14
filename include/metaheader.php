<?php
session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
  header("Location: login");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient Information Management System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="plugins/fullcalendar/main.css">
  <link rel="shortcut icon" href="img/rhu-logo.png" type="image/x-icon">


<style>

  .message-box {
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    z-index: -1;
    width: 100%;
  }

  .success {
    background-color: #39cb75;
    color: white;
  }

  .error {
    background-color: #f44336;
    color: white;
  }


 .btn_choose{

    cursor: pointer;

 }

 .btn_choose:hover{

  background-color:yellow;

}
</style>

</head>


