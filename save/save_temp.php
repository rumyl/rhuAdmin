<?php
$init_configs = parse_ini_file("../APPS.ini");
require_once '../core/init.php';
date_default_timezone_set('Asia/Manila');
 if(isset($_POST["services"]))  
 {  
 	
           $content = array(
            'services'         => $_POST["services"],
            'price'            => $_POST["price"],
            'res_id'           => $_POST["res_id"],
            'payment_date'     => date("Y/m/d")
          );

          $insert = DB::insert("tbl_temp_service",$content);  
          $check = 1;
        
echo $check;
}
?>