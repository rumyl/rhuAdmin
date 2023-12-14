<?php
require_once "includes/metaheader.php";
require_once "includes/header.php";
require_once "config/master.php";

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Brgy Indigency</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Brgy. Indigency</li>
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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Application for Brgy Indigency</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
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
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" class="form-control" id="req_date">

                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Reason</label>
                       <textarea class="form-control" id="reason"></textarea>


                    </div>                      
                    <div class="form-group">
                      <label for="exampleInputEmail1">Details</label>
                      
                      <textarea class="form-control" id="details"></textarea>

                    </div>                   
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <button type="submit" id="btn_print" class="btn btn-primary">Print and Save</button>
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

<script>
  

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

  $(document).on('click', '#res_search', function(){  
           var pid = $(this).data('pid');
           $('#resident_search').val($(this).text());  
           $('#res_id').val(pid);  
           $('#resident_list').fadeOut();
      }); 

  $(document).on('click', '#btn_print', function(){  
        
        if (confirm("Save and Print ?")){
        
        var res_id = $('#res_id').val();
        var req_date = $('#req_date').val();
         var reason = $('#reason').val();
          var details = $('#details').val();

              $.ajax({  
                     url:"print_indigency.php",  
                     method:"POST",  
                     data:{res_id:res_id, req_date:req_date,details:details,reason:reason},  
                     success:function(data){

                    var w         = 750;
                    var h         = 800;
                    var left      = (screen.width/2)-(w/2);
                    var top       = (screen.height/2)-(h/2);

                    window.open('print_indigency.php?res_id='+res_id+'&req_date='+req_date+'&details='+details+'&reason='+reason, 'Print Sales Invoice', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
                }
             });

        }
      }); 

</script>

  <?php

  require_once 'include/footer.php';

  ?>