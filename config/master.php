<?php
require_once 'config/config.php'; 
require_once 'config/db.php'; 
require_once 'config/crud.php'; 
require_once 'config/token.php';


$databaseObj = new Database();
$conn = $databaseObj->getConnection();
$crud = new CRUD($conn);


$tokenGenerator = new Token();
$generatedToken = $tokenGenerator->getToken();


$tableName = "tbl_online";
//$conditions = ['status = pending', 'registered < NOW() - INTERVAL 5 MINUTE'];
$conditions = ['registered' >= 'NOW() - INTERVAL 5 MINUTE']; 


$result = $crud->delete($tableName, $conditions);
?>