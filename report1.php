<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";



$msg = "";
$display = "none";
$alert = ""; //error //success

        if(isset($_GET['year'])){

            $year      = $_GET['year'];
            $month     = $_GET['month'];

           
        }else{

            $year  = "";
            $month = 0;
        }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">


      <div class="message-box <?php echo $alert ?>" id="msg" style="display:<?php echo $display ?>;">
              <?php echo $msg ?>
      </div>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Monthly Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Monthly Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Report Generator</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-20">
                <form action="" method="get">
                <div class="row">
                    
                    <div class="col-md-2">
                        <input type="number" class="form-control" placeholder="Year" name="year" min="1999" step="1" id="" required>
                    </div>
                    <div class="col-md-4">
                    <select name="month" class="form-control" id="monthDropdown">
                        <option selected disabled required>Select Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success" name="submit" value="Submit">
                    </div>
                </div>
                </form>
            <br><br>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">Month</th>
                                                <th style="text-align:center;">Patients Served</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                               $sql = "SELECT COUNT(*) as counter FROM tbl_appointment WHERE YEAR(appointment_date) = '$year' AND MONTH(appointment_date) = '$month' AND status = 'SERVED'";
                                               $records = $crud->read($sql);
                                               if ($records !== false) {
                                               foreach($records as $record) {

                                                 ?>
                                                <tr>
                                                    
                                                    <td class="mailbox-subject" style="text-align:center;"><b><?php echo $crud->getMonthName($month)." - ".$year ?></td>
                                                    <td class="mailbox-date" style="text-align:center;"><?php echo $record['counter'] ?></td>
                                                    
                                                </tr>
                                               <?php 
                                                 }
                                               } 
                                            ?>
                                            </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <?php
  require_once 'include/footer.php';
  ?>