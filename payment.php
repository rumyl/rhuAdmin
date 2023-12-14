<?php
$init_configs = parse_ini_file("APPS.ini");
 require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $init_configs['SITE_FOLDER'] . '/core/init.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $init_configs['SITE_FOLDER'] . '/include/metaheader.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $init_configs['SITE_FOLDER'] . '/include/header.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $init_configs['SITE_FOLDER'] . '/include/sidebar.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
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
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Payments</h3>
                </div>

                  <div class="card-body">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Resident Name</label>
                      <input type="email" class="form-control" id="resident_search" placeholder="Search Name (Lastname or Firstname)">
                       <input type="text" name="res_id" id="res_id" style="display: none;" class="form-control">
                  <table class="table table-bordered table-hover" style= "white-space: nowrap; text-overflow: ellipsis; overflow-x: auto; font-size: 1.0em; width: 100%;">
                        <tbody id="resident_list">
                        </tbody>
                  </table> 
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Service</label>
                      <select class="form-control" name="services" id="services">
                          <option selected="selected" value="">Select Services</option>
                          <option value="Brgy Clearance">Brgy Clearance</option>
                          <option value="Brgy Certification">Brgy Certification</option>
                          <option value="Brgy Indigency">Brgy Indigency</option>
                           <option value="Brgy Permit">Brgy Permit</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input type="number" step="5" name="price" id="price" class="form-control" value="50">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <button type="button" id="save_temp" class="btn btn-primary">Add</button>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Services Availed</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Services</th>
                      <th style="text-align: center;">Amount</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="temp_list">
                                            
                  </tbody>
                </table>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
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
<script>
  

//function mag get it mga services nga gin avail =)
function temp_service(x){

                    $.ajax({  
                     url:"retrieve/retrieve_temp_service.php",  
                     method:"POST",  
                    data: {
                      x: x,   
                     },
                     success:function(data)  
                     {  

                          $('#temp_list').fadeIn();  
                          $('#temp_list').html(data);  
                     }
                     }); 
  }


 //raya hay para sa pag save it services nga gin avail =)
 $(document).on('click', '#save_temp', function(){  
           var price  = $('#price').val();
           var services = $('#services').val();
           var res_id   = $('#res_id').val();


           if(price =="" || services =="" || res_id == ""){

              alert("All fields are required.")

           }else{

              $.ajax({
                url: "save/save_temp.php",
                type: "POST",
                data: {
                  services: services,
                  price: price,  
                  res_id: res_id     
                },
                cache: false,
                success: function(dataResult){

                    if(dataResult == 1){

                        temp_service(res_id);
                        $('#services').val('Select services');
                        $('#price').val('');

                    }
                }
              });
          }
      }); 


//raya hay search bar para mag usoy it resident =)
 $(document).ready(function(){  
      $('#resident_search').keyup(function(){  
           var query = $(this).val();  
           if(query != ''){

                    $.ajax({  
                     url:"retrieve/search_resident2.php",  
                     method:"POST",  
                     data:{query:query},  
                     //contentType: "application/json; charset=utf-8",
                     success:function(data)  
                     {  
                          //alert(data);
                          $('#resident_list').fadeIn();  
                          $('#resident_list').html(data);  
                     }
               
                });  

           }else{
              $('#resident_list').html('');  
              $('#resident_list').val(0);  
           }


      });  
 }); 


//raya hay once i click du gin search nga resident =)
  $(document).on('click', '#res_search', function(){  
           var pid = $(this).data('pid');
           $('#resident_search').val($(this).text());  
           $('#res_id').val(pid);  
           $('#resident_list').fadeOut();
      }); 

</script>


  <?php

  require_once 'include/footer.php';

  ?>