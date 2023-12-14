<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";


$msg = "";
$display = "none";
$alert = ""; //error //success

if(isset($_POST['btn_book'])) {

  $tableName = 'tbl_appointment';


  $conditions = array(
            'patient_id'        => $_POST['patID'],
            'status'            => "Pending",
            'appointment_date'  => $_POST['appointment_date']
  );

  if ($crud->areValuesUnique($tableName, $conditions)) {
    

              $dataToInsert = array(
                'patient_id'         => $_POST['patID'],
                'doctor_id'          => 0,
                'findings'           => $_POST['diagnosis'],
                'treatment'          => "",
                'staff_id'           => $_SESSION['user_id'],
                'appointment_date'   => $_POST['appointment_date'],
                'appointment_time'   => $_POST['appointment_time'],
                'type'               => "walk-in",
                'status'             => "Pending"
            );
            
            $inserted= $crud->create('tbl_appointment', $dataToInsert);
            
            if($inserted){
                $alert = "success";
                $msg = "Data saved successfully!";
                $display = "block";
                echo '<meta http-equiv="refresh" content="2;url=medication">';

            }
    }else{
      $alert = "error";
      $msg = "Record already exists!";
      $display = "block";
      echo '<meta http-equiv="refresh" content="2;url=medication">';

    } 
}   

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

      <div class="message-box <?php echo $alert ?>" id="msg" style="display:<?php echo $display ?>;">
              <?php echo $msg ?>
      </div>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Medication</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Medication</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12 connectedSortable">


           <div class="row">
            <!-- left column -->
            <div class="col-md-5">
              <!-- general form elements -->
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Medication and Treatment</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                     <div class="form-group">
                      <form method="post" action="">
                      <label for="exampleInputEmail1">Patient Name</label>
                      <input type="text" class="form-control" id="pat_search" autocomplete="off" placeholder="Search Name (Lastname or Firstname)">
                       <input type="text" name="patID" id="patID" style="display: none;" class="form-control">
                       <table>
                        <tbody id="patient_list">
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Select Time</label>
                      <input type="text" style="display:none;" id="appointment_date"  name="appointment_date"  value="<?php echo date('Y-m-d'); ?>"  >
                      <select id= "appointment_time" name="appointment_time" class="form-control">
                        <option>Please Select Time</option>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Diagnosis</label>
                      <textarea name="diagnosis" class="form-control" style="min-height:200px;max-height:200px;"></textarea>

                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <input type="submit" name="btn_book" class="btn btn-success" value="Book">
                  </form>
                  </div>
              </div>
            </div>

            <div class="col-md-7">
              <!-- general form elements -->
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Appointment List</h3>
                  <br>
                  <a href=""><span style="font-size:10pt;">Refresh List</span></a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                  <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Patient's Name</th>
                                                <th>Booking Type</th>
                                                <th>Time</th>
                                                <th style="text-align: center;width:20%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="appointment_list">
                                            <?php
                                                $today = date('Y-m-d');
                                                $timestamp = strtotime($today);
                                                $formattedDate = date('Y-m-d', $timestamp);


                                                $sql = "SELECT *
                                                FROM tbl_appointment INNER JOIN tbl_patients ON tbl_appointment.patient_id = tbl_patients.patient_id WHERE tbl_appointment.status = 'Pending' AND tbl_appointment.appointment_date ='$formattedDate' ORDER BY tbl_appointment.appointment_time ASC";
                                                $records = $crud->read($sql);
                                                if ($records !== false) {
                                                foreach($records as $record) {
                                                    $id         = $record['id'];
                                                    $patient_id = $record['patient_id'];
                                                    $name       = $record['lname']. ", ". $record['fname']. " ".$record['mname'];
                                                    $dob        = $record['dob'];
                                                    
                                                    ?>
                                                      <tr>
                                                        <td style="text-align:left;width:40%;"><?php echo $name ?></td>
                                                        <td><?php echo $record['type'] ?></td>
                                                        <td><?php echo $record['appointment_time'] ?></td>
                                                        <td style="width:20%;text-align:center;">                      
                                                            <button class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>
                                                            <a href="medication?id=<?php echo $id; ?>&action=remove"  onclick="return confirm('Are you sure you want to remove this record?');"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                                        </td>
                                                        </tr>
                                                      <?php
                                                  }
                                                } 
                                            
                                            ?>
                                        </tbody>
                                    </table>
                  </div>
                  <!-- /.card-body -->
              </div>
            </div>
          </div>

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script>
    
  getTime();                                         

  function getTime() {

  $(document).ready(function() {

    var appointment_date = $("#appointment_date").val();
    $.ajax({
                    url: "get_time.php",
                    method: "GET",
                    data: { appointment_date: appointment_date },
                    dataType: "json",
                    success: function(response) {
                        
                        $("#appointment_time").html(response);
                        
                    }
            });
  });
  }


  $(document).ready(function(){  
      $('#pat_search').keyup(function(){  
           var query = $(this).val();  
            if(query != ''){

                      $.ajax({  
                      url:"get_patients2.php",  
                      method:"GET",  
                      data:{query:query},  
                      //contentType: "application/json; charset=utf-8",
                      success:function(data)  
                      {  
                            $('#patient_list').fadeIn();  
                            $('#patient_list').html(data);  
                      }
                
                  });  

            }else{
              location.reload(); 
            }
            });  
  });

  $(document).ready(function() {
    
    $('#patient_list').on('click', '.btn_choose', function() {
        // Get the data-pid attribute value from the clicked row
        var patientID = $(this).data('pid');
        var patientName = $(this).find('td:first').text();
        
        $('#pat_search').val(patientName);
        $('#patID').val(patientID);

        $('#patient_list').fadeOut();
    });
});
  </script>

  <?php

  require_once 'include/footer.php';

  ?>