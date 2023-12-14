<?php

require_once 'include/metaheader.php';
require_once 'include/header.php';
require_once 'include/sidebar.php';

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Brgy ID</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Brgy. ID</li>
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
                  <h3 class="card-title">Application for Brgy ID</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Resident Name</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Search Name (Lastname or Firstname)">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Search Name (Lastname or Firstname)">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="text-align:right;">
                    <button type="submit" class="btn btn-primary">Print and Save</button>
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
  <?php

  require_once 'include/footer.php';

  ?>