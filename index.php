<?php
session_start();
include 'init.php';
// cek ada session logout atua tidak
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    // header('Location: index.php');
    header('Location: login.php');
}

if (isset($_GET['logout'])) {
    $l = new Auth();
    $data = $l->logout();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pengaduan Masyarakat</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light ml-3">Pengaduan Masyarakat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php if (isset($_SESSION['level'])): ?>
            <?php if ($_SESSION['level'] == '1' || $_SESSION['level'] == '0'): ?>

              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=petugas" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Petugas
                  </p>
                </a>
              </li>


              <li class="nav-item">
                <a href="?page=user" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    User
                  </p>
                </a>
              </li>
            <?php endif; ?>

          <?php endif; ?>

          <li class="nav-item">
            <a href="?page=pengaduan" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Pengaduan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="?page=tanggapan" class="nav-link">
              <i class="nav-icon fas fa-reply " style="transform:rotate(180deg);"></i>
              <p>
                Tanggapan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="?logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid">
          <?php if (isset($_GET['page'])): ?>
              <?php if (file_exists('views/'.$_GET['page'].".php")): ?>
                  <?php include "views/".$_GET['page'].".php" ?>
                  <?php else: ?>
                      <?php if (isset($_SESSION['level'])): ?>
                          <?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 0 ): ?>
                              <br>
                              <div class="row ">
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-info">
                                    <div class="inner">
                                      <h3>150</h3>
                                      <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-success">
                                    <div class="inner">
                                      <h3>53<sup style="font-size: 20px">%</sup></h3>

                                      <p>Bounce Rate</p>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-warning">
                                    <div class="inner">
                                      <h3>44</h3>

                                      <p>User Registrations</p>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                  <!-- small box -->
                                  <div class="small-box bg-danger">
                                    <div class="inner">
                                      <h3>65</h3>

                                      <p>Unique Visitors</p>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                  </div>
                                </div>
                                <!-- ./col -->
                              </div>
                          <?php endif; ?>
                          <?php else: ?>
                              <marquee style="font-size:30px ;padding-top:5rem">
                                  Hello <?php echo $_SESSION['user'] ?>
                              </marquee>
                      <?php endif; ?>

              <?php endif; ?>
          <?php else: ?>
              <?php if (isset($_SESSION['level'])): ?>
                  <?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 0 ): ?>
                      <br>
                      <div class="row ">
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>150</h3>
                              <p>New Orders</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>53<sup style="font-size: 20px">%</sup></h3>

                              <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>44</h3>

                              <p>User Registrations</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>65</h3>

                              <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                  <?php endif; ?>
                  <?php else: ?>
                      <marquee style="font-size:30px ;padding-top:5rem">
                          Hello <?php echo $_SESSION['user'] ?>
                      </marquee>
              <?php endif; ?>
          <?php endif; ?>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 Wahyu Purnama</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- admin lte -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>

</body>
</html>
