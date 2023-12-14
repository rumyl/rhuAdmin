<?php
require_once 'config/master.php';

if(isset($_GET['user_id'])) {

                $user_id = $_GET['user_id'];

                $results = '';
                $gets = "SELECT * FROM tbl_users WHERE user_id ='$user_id'";
                $get = $crud->getSingleRow($gets);
                $usertype = $get['usertype'];

                $results .= '<form method="post" action="">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname</label>
                      <div class="col-sm-10">
                        <input type="text" name="fullname" class="form-control" id="inputEmail3" value="'.$get['fullname'].'" placeholder="Fullname" required>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="inputEmail3" value="'.$get['username'].'" placeholder="Username" required>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Usertype</label>
                      <div class="col-sm-10">
                        <select name="usertype" class="form-control" required>
                            <option selected="selected" value="">Please Select User Type</option>
                            <option value="DOCTOR" ' . (($usertype == 'DOCTOR') ? 'selected' : '') . '>DOCTOR</option>
                            <option value="STAFF" ' . (($usertype == 'STAFF') ? 'selected' : '') . '>STAFF</option>
                        </select>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Position</label>
                      <div class="col-sm-10">
                        <input type="text" name="position" class="form-control" id="inputEmail3" value="'.$get['position'].'" placeholder="Position" required>
                        <input type="hidden" name="user_id"  value="'.$user_id.'">  
                    </div>
                </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" name="update_user" class="btn btn-primary" value="Update">
                </form>';

                             
                echo json_encode($results);
}

?>
