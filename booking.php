<?php
require_once "config/master.php";

require_once "include/metaheader.php";
require_once "include/header.php";
require_once "include/sidebar.php";

$msg = "";
$display = "none";
$alert = ""; //error //success

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">


      <div class="message-box <?php echo $alert ?>" id="msg" style="display:<?php echo $display ?>;">
              <?php echo $msg ?>
      </div>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Online Booking</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Online Booking</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php
                                               $sql = "SELECT * FROM tbl_online WHERE status = 'approved'  ORDER by id";
                                               $records = $crud->read($sql);
                                               if ($records !== false) {
                                               foreach($records as $record) {
                               
                                                $name = $record['lname']. ", ". $record['fname']. " ".$record['mname'];
                                                $id = $record['id'];
                                                 ?>
                                                <tr>
                                                    <td class="mailbox-name"><a href="#"><?php echo $name; ?></a></td>
                                                    <td class="mailbox-subject"><b><?php echo $crud->dateToWords($record['appointment_date']) ?></b> - <?php echo $record['appointment_time'] ?>
                                                    </td>
                                                    <td class="mailbox-date"><?php echo $crud->displayRelativeDate($record['registered']) ?></td>
                                                    <td class="mailbox-attachment">
                                                        
                                                        <button class="btn btn-success btn-sm btn-approve"  data-pid =<?php echo $id; ?>>Aprove</button> | 
                                                        <button class="btn btn-danger btn-sm btn-deny"  data-pid =<?php echo $id; ?>>Deny</button>
                                                      </td>
                                                </tr>
                                               <?php 
                                                 }
                                               } 
                                            ?>

                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script src="js/email.min.js"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script>

        emailjs.init("wVg3d4jAxmEO6cB3l");
		
        function sendEmail(name, email, time, date) {
            var email = email;
            var from_name = name;

            emailjs.send("service_ldqt4wa", "template_yb5zrrl", {
                to_email: email,
                from_name: from_name,
                message: "Good Day! "+name +", your booking has been approved at "+ time +" on " + date
            })
            .then(response => {
                console.log('Email sent:', response);
                //alert('Email sent successfully!');
            })
            .catch(error => {
                console.error('Error sending email:', error);
                //alert('Error sending email. Please try again. Check console for details.');
            });
        }

        function sendEmail2(name, email, time, date) {
            var email = email;
            var from_name = name;

            emailjs.send("service_ldqt4wa", "template_yb5zrrl", {
                to_email: email,
                from_name: from_name,
                message: "Hello, "+name +" your booking has been denied."
            })
            .then(response => {
                console.log('Email sent:', response);
                //alert('Email sent successfully!');
            })
            .catch(error => {
                console.error('Error sending email:', error);
                //alert('Error sending email. Please try again. Check console for details.');
            });
        }

        function successCallback(events) {
            events.forEach(function(event) {
                sendEmail(event.name, event.email, event.time, event.date);
            });
        }

        function successCallback2(events) {
            events.forEach(function(event) {
                sendEmail2(event.name, event.email, event.time, event.date);
            });
        }

        $(document).on("click", ".btn-approve", function() {
          var id = $(this).data('pid');
          $.ajax({
              url: "save_book.php",
              method: "GET",
              data: { id: id },
              dataType: "json",
              success: function(response) {
                  // Check if response is an array
                  if (Array.isArray(response)) {
                      var events = response.map(function(event) {
                          return {
                              name: event.name,
                              email: event.email,
                              time: event.time,
                              date: event.date
                          };
                      });
                      successCallback(events); // for email

                      alert("Appointment has been booked successfuly, email has been sent to client.");
                      location.reload(); 
                      
                     
                  } else {
                      // Handle the case where the response is not an array
                      failureCallback("Invalid response format");
                  }
              },
              error: function(xhr, status, error) {
                  failureCallback(error);
              }
          });
      });

      $(document).on("click", ".btn-deny", function() {
          var id = $(this).data('pid');
          $.ajax({
              url: "deny_book.php",
              method: "GET",
              data: { id: id },
              dataType: "json",
              success: function(response) {
                  // Check if response is an array
                  if (Array.isArray(response)) {
                      var events = response.map(function(event) {
                          return {
                              name: event.name,
                              email: event.email,
                              time: event.time,
                              date: event.date
                          };
                      });
                      successCallback2(events); // for email

                      alert("Appointment has been denied, email has been sent to client.");
                      location.reload(); 
                      
                     
                  } else {
                      // Handle the case where the response is not an array
                      failureCallback2("Invalid response format");
                  }
              },
              error: function(xhr, status, error) {
                  failureCallback(error);
              }
          });
      });
  </script>

  <?php
  require_once 'include/footer.php';
  ?>