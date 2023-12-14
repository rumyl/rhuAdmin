<?php
require_once 'config/master.php';

if(isset($_GET['patient_id'])) {

                $patient_id = $_GET['patient_id'];

                $results = '';
                $gets = "SELECT * FROM tbl_patients WHERE patient_id ='$patient_id'";
                $get = $crud->getSingleRow($gets);
                $gender = $get['gender'];

                $results .= '<form method="post" action="">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="lname" class="form-control" id="inputEmail3" value="'.$get['lname'].'" placeholder="Lastname" required>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="fname" class="form-control" id="inputEmail3" value="'.$get['fname'].'" placeholder="Firstname" required>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Middle Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="mname" class="form-control" id="inputEmail3" value="'.$get['mname'].'" placeholder="Middle Name" required>
                      </div>
                </div>


                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <input type="date" name="dob" class="form-control" id="inputEmail3" value="'.$get['dob'].'" max="'.date('Y-m-d', strtotime('-1 day')).'" placeholder="Date of Birth" onfocus="(this.type="date")" required>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gender</label>
                      <div class="col-sm-10">
                        <select name="gender" class="form-control" required>
                            <option selected="selected" value="">GENDER</option>
                            <option value="MALE" ' . (($gender == 'MALE') ? 'selected' : '') . '>MALE</option>
                            <option value="FEMALE" ' . (($gender == 'FEMALE') ? 'selected' : '') . '>FEMALE</option>
                        </select>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" id="inputEmail3" value="'.$get['address'].'" placeholder="Address" >
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail3" value="'.$get['email'].'" placeholder="Email (Optional)" >
                      </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contact #</label>
                      <div class="col-sm-10">
                        <input type="text" name="contact" class="form-control" id="inputEmail3" value="'.$get['contact'].'" placeholder="Contact Number" required>  
                        <input type="hidden" name="patient_id"  value="'.$patient_id.'">
                    </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" name="update_patient" class="btn btn-primary" value="Update">
                </form>';

                             
                echo json_encode($results);
}

?>
