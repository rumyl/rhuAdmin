<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";


$msg = "";
$display = "none";
$alert = ""; //error //success


if(isset($_POST['save_patient'])) {

  
    $tableName = 'tbl_patients';

    $lname   = strtoupper($_POST['lname']);
    $fname   = strtoupper($_POST['fname']);
    $mname   = strtoupper($_POST['mname']);
    $gender  = strtoupper($_POST['gender']);
    $dob     = $_POST['dob'];
    $address = strtoupper($_POST['address']);
    $email   = strtoupper($_POST['email']);
    $contact = strtoupper($_POST['contact']);


    $conditions = array(
              'lname'  => $lname,
              'fname'  => $fname,
              'mname'  => $mname,
              'gender' => $gender,
              'dob'    => $dob
    );

    if ($crud->areValuesUnique($tableName, $conditions)) {
      
          $dataToInsert = array(
              'lname'   => $lname,
              'fname'   => $fname,
              'mname'   => $mname,
              'gender'  => $gender,
              'dob'     => $dob,
              'address' => $address,
              'contact' => $contact,
              'email'   => $email,
              'status'  => 1
          );

              $insertedId = $crud->create($tableName, $dataToInsert);
              if($insertedId){
                  $alert = "success";
                  $msg = "Data saved successfully!";
                  $display = "block";
                  echo '<meta http-equiv="refresh" content="2;url=patients">';

              }
      }else{
        $alert = "error";
        $msg = "Record already exists!";
        $display = "block";
        echo '<meta http-equiv="refresh" content="2;url=patients">';
  
      } 
  }   

    // update patient
    if (isset($_POST['update_patient'])) {
 
        $tableName = 'tbl_patients';

        $patient_id     = $_POST['patient_id'];
        $lname   = strtoupper($_POST['lname']);
        $fname   = strtoupper($_POST['fname']);
        $mname   = strtoupper($_POST['mname']);
        $gender  = strtoupper($_POST['gender']);
        $dob     = $_POST['dob'];
        $address = strtoupper($_POST['address']);
        $email   = strtoupper($_POST['email']);
        $contact = strtoupper($_POST['contact']);

        $dataToUpdate = array(
          'lname'   => $lname,
          'fname'   => $fname,
          'mname'   => $mname,
          'gender'  => $gender,
          'dob'     => $dob,
          'address' => $address,
          'contact' => $contact,
          'email'   => $email,
        );
        
        $condition = "patient_id = '{$patient_id}'";

        $updateId = $crud->update($tableName, $condition, $dataToUpdate);
            if($updateId){
                $alert = "success";
                $msg = "Patient information updated successfuly.";
                $display = "block";
                echo '<meta http-equiv="refresh" content="2;url=patients">';
    
            }
        }

        // remove patient
        if(isset($_GET['patient_id'])){

            $action         = $_GET['action'];
            $patient_id     = $_GET['patient_id'];

            $dataToUpdate = array(
                'status'  => 0
            );

            if($action == "remove"){

                $tableName = 'tbl_patients';
                $condition = "patient_id = '{$patient_id}'";
                $updateId = $crud->update($tableName, $condition, $dataToUpdate);
                $alert = "error";
                $msg = "Patient has been removed from record.";
                $display = "block";
                echo '<meta http-equiv="refresh" content="2;url=patients">';
            }


        }



?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">

      <div class="message-box <?php echo $alert ?>" id="msg" style="display:<?php echo $display ?>;">
              <?php echo $msg ?>
      </div>

      <div class="modal fade" id="modal-exam">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Patient</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="lname" class="form-control" id="inputEmail3" placeholder="Lastname" required>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="fname" class="form-control" id="inputEmail3" placeholder="Firstname" required>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Middle Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="mname" class="form-control" id="inputEmail3" placeholder="Middle Name" required>
                      </div>
                </div>


                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <input type="text" name="dob" class="form-control" id="inputEmail3"  max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" placeholder="Date of Birth" onfocus="(this.type='date')" required>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gender</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="gender" required>
                          <option selected="selected">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" id="inputEmail3" placeholder="Address" >
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Email (Optional)" >
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contact #</label>
                      <div class="col-sm-10">
                        <input type="text" name="contact" class="form-control" id="inputEmail3" placeholder="Contact Number" required>
                      </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" name="save_patient" class="btn btn-primary" value="Save">
                </form>
              </div>
            </div>
          </div>
        </div>


          <div class="modal fade" id="modal-edit">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Patient Info</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="edit_info">
                  
                </div>
              </div>
            </div>
          </div>


        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Patients Profile</h1>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-exam">
                  Add New Patient
            </button>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Patients</li>
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
          <div class="col-lg-12 col-12">
            <!-- small box -->
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Patients</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card-body">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Patient Name</label>
                      <input type="text" class="form-control" id="pat_search" placeholder="Search Name (Lastname or Firstname)">
                       <input type="text" name="patID" id="patID" style="display: none;" class="form-control">
                    </div>
                                  <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Patient's Name</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Date of Birth</th>
                                                <th>Contact Information</th>
                                                <th style="text-align: center;width:30%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="patient_list">
                                            <?php
                                               $sql = "SELECT * FROM tbl_patients WHERE status = 1  ORDER by lname ASC LIMIT 100";
                                               $records = $crud->read($sql);
                                               if ($records !== false) {
                                               foreach($records as $record) {
                               
                                                   $patient_id = $record['patient_id'];
                               
                                                   $name = $record['lname']. ", ". $record['fname']. " ".$record['mname'];
                                                   $dob = $record['dob'];
                                                   $age = $crud->calculateAge($dob);
                               
                                                 ?>
                                                   <tr>
                                                       <td style="text-align:left;"><?php echo $name ?></td>
                                                       <td style="text-align:left;"><?php echo $record['gender']; ?></td>
                                                       <td style="text-align:center;"><?php echo $age ?></td>
                                                       <td style="text-align:center;"><?php echo $crud->dateToWords($record['dob']) ?></td>
                                                       <td style="text-align:center;"><?php echo $record['email']." / ".$record['contact'] ?></td>
                                                       <td>
                                                        <a href="history?patient_id=<?php echo $patient_id; ?>">
                                                          <button class="btn btn-success btn-sm btn-history"  data-pid =<?php echo $patient_id; ?>>History</button> | 
                                                        </a>   
                                                        <button class="btn btn-warning btn-sm btn-editPatient"  data-pid =<?php echo $patient_id; ?>>Edit</button> |
                                                         <a href="patients?patient_id=<?php echo $patient_id; ?>&action=remove"  onclick="return confirm('Are you sure you want to remve this record?');"><button class="btn btn-danger btn-sm">Delete</button></a></td>
                                                       </tr>
                                               <?php 
                                                 }
                                               } 
                                            ?>
                                        </tbody>
                                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script>

  $(document).ready(function(){  
      $('#pat_search').keyup(function(){  
           var query = $(this).val();  
            if(query != ''){

                      $.ajax({  
                      url:"get_patients.php",  
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


      $(document).on("click", ".btn-editPatient", function() {
          var patient_id = $(this).data('pid');
          $.ajax({
              url: "edit_patient.php",
              method: "GET",
              data: { patient_id: patient_id },
              dataType: "json",
              success: function(response) {
                
                  $('#modal-edit').modal('show');
                  $("#edit_info").html('');
                  $("#edit_info").html(response);
              },
              error: function(xhr, status, error) {
                  console.error("Ajax request failed:", error);
              }
          });
      });
  </script>


  <?php
  require_once 'include/footer.php';
  ?>