<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";


$msg = "";
$display = "none";
$alert = ""; //error //success

if(isset($_POST['btn_upload'])) {

  $tableName = 'tbl_radiology';

  $radFile = $_FILES['rad_file'];

  // Validate file upload
  if ($radFile['error'] === UPLOAD_ERR_OK && $radFile['type'] === 'application/pdf') {
      
      // Move uploaded file to a specific directory
      $uploadDirectory = 'uploads/';
      $uploadedFilePath = $uploadDirectory . basename($radFile['name']);

      if (move_uploaded_file($radFile['tmp_name'], $uploadedFilePath)) {
          
          // Data to insert into the database
          $dataToInsert = array(
              'rad_file'       => $uploadedFilePath,
              'rad_details'    => $_POST['rad_details'],
              'patient_id'     => $_POST['patID'],
          );

          // Insert data into the database
          $inserted = $crud->create($tableName, $dataToInsert);

          if($inserted) {
              $alert = "success";
              $msg = "File uploaded saved successfully!";
              $display = "block";
              echo '<meta http-equiv="refresh" content="2;url=radiology">';
          } else {
              $alert = "error";
              $msg = "Error saving data to the database.";
              $display = "block";
          }
      } else {
          $alert = "error";
          $msg = "Error moving uploaded file to the server.";
          $display = "block";
      }
  } else {
      $alert = "error";
      $msg = "Invalid file type or error in file upload.";
      $display = "block";
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
            <h1 class="m-0">Radiology</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Radiology</li>
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
                  <h3 class="card-title">Upload Radiology Results</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                     <div class="form-group">
                      <form method="post" action="" enctype="multipart/form-data">
                      <label for="exampleInputEmail1">Patient Name</label>
                      <input type="text" class="form-control" id="pat_search" autocomplete="off" placeholder="Search Name (Lastname or Firstname)">
                       <input type="text" name="patID" id="patID" style="display: none;" class="form-control">
                       <table>
                        <tbody id="patient_list">
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <textarea name="rad_details" class="form-control" style="min-height:200px;max-height:200px;"></textarea>
                          <input type="file" id="pdfFile" name="rad_file" accept="application/pdf" required>
                    </div>
                  
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <input type="submit" name="btn_upload" class="btn btn-success" value="Upload">
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
  <script>


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