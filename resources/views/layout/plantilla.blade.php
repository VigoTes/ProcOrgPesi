<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FODA XXX System</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">

    
    <!-- Font Awesome ESTOS SON LOS ICONOS WE XD-->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">


    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
 

  </head>










<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
          
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>

            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Messages Dropdown Menu -->
              <li class="nav-item dropdown">
          
              </li>
              <!-- Notifications Dropdown Menu -->
            
              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>
              <li class="nav-item">
              
              </li>
            </ul>

            
          </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FODA System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Diego Vigo</a>
        </div>
      </div>

 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
          <li class="nav-item menu">    {{-- AQUI FALTARIA LA SELECCION --}}
            <a href="{{route('empresa.index')}}" class="nav-link">
              <i class="fas fa-briefcase"></i>
              <p>
                Empresas
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>

         {{-- <li class="nav-item menu-closed">
            <a href="#" class="nav-link">
              <i class="fas fa-list-alt"></i>
              <p>
                Estrategias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./estrategiasFO" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FO</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./estrategiasFA" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FA</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./estrategiasDO" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DO</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./estrategiasDA" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DA</p>
                </a>
              </li>
              

            </ul>
          </li> --}}



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{--                                       <div class="content-header">
                                            <div class="container-fluid">
                                              <div class="row mb-2">
                                                <div class="col-sm-6">
                                                  <h1 class="m-0">Foda Main Panel</h1>
                                                  
                                                </div><!-- /.col -->
                                                <div class="col-sm-6">
                                                  <ol class="breadcrumb float-sm-right">

                                                  </ol>
                                                </div><!-- /.col -->
                                              </div><!-- /.row -->
                                            </div><!-- /.container-fluid -->
                                          </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->

      <section class="content">
        @yield('contenido')
     
      </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>

<script src="plugins/raphael/raphael.min.js"></script>

<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>

<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->

<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
