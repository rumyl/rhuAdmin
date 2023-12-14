
<?php if($_SESSION["usertype"] == "Administrator") { ?>
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
            <li class="nav-item">
            <a href="dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="booking" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
              Online Booking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="patients" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
              Patients
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="medication" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medication</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laboratory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laboratory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="radiology" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Radiology</p>
                </a>
              </li>
              
            </ul>
          </li>   
          <li class="nav-item">
            <a href="users" class="nav-link">
              <i class="nav-icon fa fa-wrench"></i>
              <p>
              User Accounts
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php  }else if ($_SESSION["usertype"] == "STAFF"){  ?>
  <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
            <li class="nav-item">
            <a href="dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="booking" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
              Online Booking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="patients" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
              Patients
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="medication" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medication</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laboratory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laboratory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="radiology" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Radiology</p>
                </a>
              </li>
              
            </ul>
          </li>   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php  }else if ($_SESSION["usertype"] == "DOCTOR"){  ?>
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
            <a href="dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pending" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Appointment
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php  } ?>