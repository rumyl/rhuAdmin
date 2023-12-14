<?php
session_start();
require_once 'config/master.php'; 


$msg = "";
$display = "none";
$alert = ""; //error //success


if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

  if($username == "admin" && $password == "admin"){
    $_SESSION["user_id"] = "-1";
    $_SESSION["fullname"] = "Administrator";
    $_SESSION["usertype"] = "Administrator";
    header("Location: index"); // Redirect to the index 
  
  }else{

    $sql = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'"; 
    $row = $crud->getSingleRow($sql);
    
      if($row){
       
        $_SESSION["user_id"]  = $row['user_id'];
        $_SESSION["fullname"] = $row['fullname'];
        $_SESSION["usertype"] = $row['usertype'];
        
        if($_SESSION['usertype']== "DOCTOR"){
          header("Location: pending"); 
        }else if($_SESSION['usertype']== "STAFF"){
          header("Location: dashboard"); 
        }


      }else{
        $alert = "error";
        $msg = "Incorrect password. Access denied.";
        $display = "block";
    
      }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Information Management System</title>
  <link rel="icon" href="img/rhu-logo.png" type="image/gif" sizes="16x16">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e0e0e0;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }
    
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .logo img {
      width: 200px;
      height: 180px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      font-size: 14px;
      color: #36C08F;
    }
    
    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 2px solid #36C08F ;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
      color: #000;
      background-color: #f1f1f1;
    }
    
    .form-group input[type="submit"] {
      background-color: #36C08F ;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    
    .form-group input[type="submit"]:hover {
      background-color: #660000;
    }

    .form-group .show-password {
      margin-top: 10px;
      color: #000;
      cursor: pointer;
      text-align:right;
      font-size: 14px;
    }


    footer {
    margin-top: 50px;
    text-align: center;
    font-size: 14px;
    color: #888;
    }

    footer hr {
    border: none;
    border-top: 1px solid #ccc;
    margin: 10px 0;
    }

    footer p {
    margin: 5px 0;
    }

    footer a {
    color: #333;
    text-decoration: none;
    }

    .form-group .already {
      margin-top: 10px;
      color: #000;
      cursor: pointer;
      text-align:left;
      font-size: 14px;
    }
    h2 {
      text-align: center;
    }

    .message-box {
      padding: 10px;
      margin: 10px;
      border-radius: 5px;
      font-weight: bold;
      text-align: center;
      width: 95%;
    }

    .success {
      background-color: #4CAF50;
      color: white;
    }

    .error {
      background-color: #f44336;
      color: white;
    }
  </style>
  <script>
    function togglePassword() {
      var passwordInput = document.getElementById("password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
  </script>
</head>
<body>
<div class="message-box <?php echo $alert ?>" id="msg" style="display:<?php echo $display ?>;">
        <?php echo $msg ?>
    </div>
  <div class="container">
    <div class="logo">
      <img src="img/rhu-logo.png"  alt="Clinic Logo">
    </div>
    <form action="" method="POST">
    <h2>Login Form</h2>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" autocomplete="off" placeholder="Enter your username" autofocus required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" autocomplete="off" placeholder="Enter your password" required>
        <div class="show-password" onclick="togglePassword()">Show Password</div>
      </div>
      <div class="form-group" style="text-align:right;">
        <input type="submit" name="login" value="Sign-in">
      </div>
    </form>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">ASU-CIT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</body>
</html>


<script>
  // Get the current year
  var currentYear = new Date().getFullYear();
  // Update the content of the element with the current year
  document.getElementById("currentYear").textContent = currentYear;


  var milliseconds = 2000;

  setTimeout(function () {
      document.getElementById('msg').remove();
  }, milliseconds);

</script>