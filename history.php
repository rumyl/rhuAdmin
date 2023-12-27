<?php
require_once "config/master.php";

require_once 'include/metaheader.php';
require_once 'include/header.php';
require_once 'include/sidebar.php';

if(isset($_GET['patient_id'])){

  $patient_id = $_GET['patient_id'];
  $sql = "SELECT * FROM tbl_patients WHERE patient_id = '$patient_id'";
  $get = $crud->getSingleRow($sql);


}

?>

  <div class="modal fade" id="modal-qr">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">QR Code Generator</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body" style="width:100%; height:300px;text-align:center;">
                    <div>Password for PDF is the birthday of Patient in MMDDYY (example: <i><b>102621</b></i>) October 26, 2021  </div>
                    <div id="qrcode" style="width:100px; height:100px;"></div>
                    
                  </div>
              </div>
          </div>
      </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Patient's History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Patient's History</li>
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
    
        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="img/user_2.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $get['fname']." ".$get['mname']." ".$get['lname'] ?></h3>

                <p class="text-muted text-center"><?php echo $get['address'] ?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-8">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Medication</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Date</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                                    $siteUrl = gethostbyname(gethostname()); // Replace with your actual site URL
                                      $sql = "SELECT * FROM tbl_appointment WHERE patient_id ='$patient_id' AND status = 'Served' ORDER BY appointment_time DESC";
                                                $records = $crud->read($sql);
                                                if ($records !== false) {
                                                foreach($records as $record) {
                                                  $fullSiteUrl = $siteUrl . "/rhuAdmin/print_receipt=" . $record['id'];
                                                    
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $crud->dateToWords($record['appointment_date']) ?></td>
                                                        <td style="width:50%;text-align:center;">                      
                                                            <button type="button" class="btn btn-sm btn-success btn-view" data-pid =<?php echo $record['id']; ?>>View Record</button>
                                                            <button type="button" class="btn btn-sm btn-info btn-generate" data-pid =<?php echo $fullSiteUrl; ?>>Generate QR</button>
                                                        </td>
                                                        </tr>
                                                      <?php
                                                  }
                                                }    
                                            ?>            
                  </tbody>
                </table>
                  </div>
              </div>
              

              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Laboratory</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Date</th>
                      <th style="text-align: center;">Name</th>
                      <th style="text-align: center;">File</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                          $sql = "SELECT * FROM tbl_laboratory WHERE patient_id ='$patient_id' ORDER BY uploaded_date DESC";
                            $records = $crud->read($sql);
                            if ($records !== false) {
                            foreach($records as $record) {

                                ?>
                                  <tr>
                                    <td><?php echo $crud->dateToWords($record['uploaded_date']) ?></td>
                                    <td><?php echo $record['lab_details'] ?></td>
                                    <td><?php echo $record['lab_file'] ?></td>
                                    <td style="width:20%;text-align:center;">   
                                      <a href="<?php echo $record['lab_file'] ?>" target ="_blank">                  
                                        <button type="button" class="btn btn-sm btn-success">Download</button>
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
                </form>
              </div>


              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Radiology</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Date</th>
                      <th style="text-align: center;">Name</th>
                      <th style="text-align: center;">File</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                          $sql = "SELECT * FROM tbl_radiology WHERE patient_id ='$patient_id' ORDER BY uploaded_date DESC";
                            $records = $crud->read($sql);
                            if ($records !== false) {
                            foreach($records as $record) {

                                ?>
                                  <tr>
                                    <td><?php echo $crud->dateToWords($record['uploaded_date']) ?></td>
                                    <td><?php echo $record['rad_details'] ?></td>
                                    <td><?php echo $record['rad_file'] ?></td>
                                    <td style="width:20%;text-align:center;">   
                                      <a href="<?php echo $record['rad_file'] ?>" target ="_blank">                  
                                        <button type="button" class="btn btn-sm btn-success">Download</button>
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
                </form>
              </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript" src="qr/qrcode.js"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script>
    
  $(document).on('click', '.btn-view', function(){  
        
        if (confirm("View Record?")){
        
                        var id = $(this).data('pid');
                        var w         = 750;
                        var h         = 800;
                        var left      = (screen.width/2)-(w/2);
                        var top       = (screen.height/2)-(h/2);

                        return window.open('print_receipt.php?id='+id, 'Print Receipt', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
          


        }
      }); 


      function makeCode (link) {		

        if (!link.value) {
          alert("Input a text");
          elText.focus();
          return;
        }
        
        qrcode.makeCode(link.value);
      }


      $(document).on('click', '.btn-generate', function() {
        if (confirm("Generate QR Code")) {

            var id = $(this).data('pid');
            var link = id;
            
            $('#modal-qr').modal('show').on('shown.bs.modal', function() {
                // Initialize QRCode inside the modal
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    width: 200,
                    height: 200
                });

                // Generate the QR code
                qrcode.makeCode(link);
            });
            
        }
    });
  </script>
  <?php

  require_once 'include/footer.php';

  ?>