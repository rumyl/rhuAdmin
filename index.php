<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}else{

    header("Location: dashboard");
}
?>