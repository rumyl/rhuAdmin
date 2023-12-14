<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Appoinment List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Pending</li>
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
            
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">List Patients</h3>
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
                                                            <a href="treatment?id=<?php echo  $id ?>">             
                                                                <button class="btn btn-sm btn-success">Choose</button>
                                                            </a>
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


  <?php

  require_once 'include/footer.php';

  ?>