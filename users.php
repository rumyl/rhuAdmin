<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";


$msg = "";
$display = "none";
$alert = ""; //error //success


if(isset($_POST['save_user'])) {

  
    $tableName = 'tbl_users';

    $fullname   = strtoupper($_POST['fullname']);
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $usertype   = strtoupper($_POST['usertype']);
    $position   = $_POST['position'];


    $conditions = array(
              'fullname'  => $fullname,
              'username'  => $username,
              'usertype'  => $usertype,
              'position' => $position,
    );

    if ($crud->areValuesUnique($tableName, $conditions)) {
      
          $dataToInsert = array(
              'fullname'   => $fullname,
              'username'   => $username,
              'password'   => $password,
              'usertype'   => $usertype,
              'position'   => $position,
              'status'  => 1
          );

              $insertedId = $crud->create($tableName, $dataToInsert);
              if($insertedId){
                  $alert = "success";
                  $msg = "User account saved successfully!";
                  $display = "block";
                  echo '<meta http-equiv="refresh" content="2;url=users">';

              }
      }else{
        $alert = "error";
        $msg = "Record already exists!";
        $display = "block";
        echo '<meta http-equiv="refresh" content="2;url=users">';
  
      } 
  }   

    // update patient
    if (isset($_POST['update_user'])) {
 
        $tableName = 'tbl_users';

        $user_id    = $_POST['user_id'];
        $fullname   = strtoupper($_POST['fullname']);
        $username   = $_POST['username'];
        $usertype   = strtoupper($_POST['usertype']);
        $position   = $_POST['position'];
    

        $dataToUpdate = array(
          'fullname'   => $fullname,
          'username'   => $username,
          'usertype'   => $usertype,
          'position'   => $position,
          'status'  => 1
      );
        
        $condition = "user_id = '{$user_id}'";

        $updateId = $crud->update($tableName, $condition, $dataToUpdate);
            if($updateId){
                $alert = "success";
                $msg = "User information updated successfuly.";
                $display = "block";
                echo '<meta http-equiv="refresh" content="2;url=users">';
    
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
                      <h4 class="modal-title">Add New User Account</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="post" action="">
                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname</label>
                              <div class="col-sm-10">
                                  <input type="text" name="fullname" class="form-control" placeholder="Fullname" required>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" name="username" class="form-control" placeholder="Username" required>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">User Type</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="usertype" required>
                                      <option selected="selected">Please Select</option>
                                      <option value="Doctor">Doctor</option>
                                      <option value="Staff">Staff</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Position</label>
                              <div class="col-sm-10">
                                  <input type="text" name="position" class="form-control" placeholder="Position">
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <input type="submit" name="save_user" class="btn btn-primary" value="Save">
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
            <h1 class="m-0">User Accounts</h1>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-exam">
                  Add New Account
            </button>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                <h3 class="card-title">List of User Accounts</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card-body">
                     <div class="form-group">
                    </div>
                                  <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fullname</th>
                                                <th>Username</th>
                                                <th>Usertype</th>
                                                <th>Position</th>
                                                <th style="text-align: center;width:30%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user_list">
                                            <?php
                                               $sql = "SELECT * FROM tbl_users WHERE status = 1  ORDER by fullname";
                                               $records = $crud->read($sql);
                                               if ($records !== false) {
                                               foreach($records as $record) {
                                                  $user_id = $record['user_id'];
                                                 ?>
                                                   <tr>
                                                    
                                                       <td style="text-align:left;"><?php echo $record['fullname']; ?></td>
                                                       <td style="text-align:left;"><?php echo $record['username']; ?></td>
                                                       <td style="text-align:left;"><?php echo $record['usertype']; ?></td>
                                                       <td style="text-align:left;"><?php echo $record['position']; ?></td>
                                                       <td  style="text-align: center;width:30%;">
                                                        <button class="btn btn-warning btn-sm btn-editUser"  data-pid =<?php echo $user_id; ?>>Edit</button> |
                                                         <a href="users?$user_id=<?php echo $user_id; ?>&action=remove"  onclick="return confirm('Are you sure you want to remve this record?');"><button class="btn btn-danger btn-sm">Delete</button></a></td>
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


        $(document).on("click", ".btn-editUser", function() {
            var user_id = $(this).data('pid');
            $.ajax({
                url: "edit_user.php",
                method: "GET",
                data: { user_id: user_id },
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