<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";


$msg = "";
$display = "none";
$alert = ""; //error //success

        if(isset($_GET['from'])){

            $from   = $_GET['from'];
            $to     = $_GET['to'];

        }else{

            $from  = "";
            $to    = "";
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
            <h1>Daily Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daily Report</li>
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
                    
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="From" name="from" max="<?php echo date('Y-m-d'); ?>" onfocus="(this.type='date')" step="1" id="" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="To" name="to" max="<?php echo date('Y-m-d'); ?>" onfocus="(this.type='date')" step="1" id="" required>
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
                                              $currentDate = $from;
                                              while (strtotime($currentDate) <= strtotime($to)) {
                                                  $sql = "SELECT '$currentDate' AS appointment_date, COUNT(id) AS date_count
                                                          FROM tbl_appointment
                                                          WHERE DATE(appointment_date) = '$currentDate' AND status = 'Served'
                                                          GROUP BY '$currentDate'";
                                              
                                                  $records = $crud->read($sql);
                                              
                                                  if ($records !== false) {
                                                      foreach ($records as $record) {
                                              ?>
                                                          <tr>
                                                              <td class="mailbox-subject" style="text-align:center;"><b><?php echo $crud->dateToWords($record['appointment_date']) ?></td>
                                                              <td class="mailbox-date" style="text-align:center;"><?php echo $record['date_count'] ?></td>
                                                          </tr>
                                              <?php
                                                      }
                                                  }
                                              
                                                  // Move to the next day
                                                  $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
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