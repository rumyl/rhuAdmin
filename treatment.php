<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";


$msg = "";
$display = "none";
$alert = ""; //error //success

if(isset($_GET['id'])){

        $id = $_GET['id'];
        $sql = "SELECT *
        FROM tbl_appointment INNER JOIN tbl_patients ON
        tbl_appointment.patient_id = tbl_patients.patient_id WHERE tbl_appointment.id ='$id'";
        $get = $crud->getSingleRow($sql);


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
            <h1 class="m-0"><a href="pending">Appointment List</a> / Treatment</h1>
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
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title"><?php echo $get['fname']." ".$get['mname']." ".$get['lname'] ?></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                     <div class="form-group">
                      <form>
                       <table>
                        <tbody id="patient_list">
                        </tbody>
                      </table>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Diagnosis</label>
                      <input type="text" style="display:none;" id="id" value="<?php echo $get['id'] ?>">
                      <textarea id="diagnosis" class="form-control" style="min-height:200px;max-height:200px;"><?php echo $get['findings'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Treatment</label>
                      <textarea id="treatment" class="form-control" style="min-height:200px;max-height:200px;"><?php echo $get['treatment'] ?></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <button type="button"  class="btn btn-success btn_treatment">Save & Print </button>
                  </form>
                  </div>
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
  <script type="text/javascript" src="qr/qrcode.js"></script>
  <script>
    
  $(document).on('click', '.btn_treatment', function(){  
        
        if (confirm("Save and Print ?")){
        
        var id         = $('#id').val();
        var treatment = $('#treatment').val();
        var diagnosis = $('#diagnosis').val();
              $.ajax({  
                     url:"save_treatment.php",  
                     method:"GET",  
                     data:{id:id, treatment:treatment,diagnosis:diagnosis},  
                     success:function(data){
                        
                        var w         = 750;
                        var h         = 800;
                        var left      = (screen.width/2)-(w/2);
                        var top       = (screen.height/2)-(h/2);

                        return window.open('print_receipt.php?id='+data, 'Print Receipt', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
                }
             });

        }
      }); 
  </script>
  <?php

  require_once 'include/footer.php';

  ?>