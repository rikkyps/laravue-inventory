
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT. Putra Sindang Grup</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- CSS STYLE LARAVEL -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition layout-fixed sidebar-mini">
<div id="app">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="topbar" v-show="$route.path == '/' || $route.path === '/register' || $route.path === '/forget' ? false : true " style="display: none;">
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
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('backend/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('backend/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('backend/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" v-show="$route.path == '/' || $route.path === '/register' || $route.path === '/forget' ? false : true " id="sidebar" style="display: none;">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">PT. PSG</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
              <router-link to="/home" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Data Karyawan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{ name: 'store-employees' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Karyawan</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'show-employees' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Semua Karyawan</p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shipping-fast"></i>
                <p>
                  Data Supplier
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{ name: 'store-suppliers' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Supplier</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'show-suppliers' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Semua Supplier</p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                  Data Kategori
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{ name: 'store-categories' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Kategori</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'show-categories' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Semua Kategori</p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                  Data Produk
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{ name: 'store-items' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Produk</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'show-items' }" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Semua Produk</p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="pages/widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Widgets
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Layout Options
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">6</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/layout/top-nav.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Top Navigation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Top Navigation + Sidebar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/boxed.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Boxed</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fixed Sidebar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/fixed-topnav.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fixed Navbar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/fixed-footer.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fixed Footer</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Collapsed Sidebar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link to="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </router-link>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
</div>
<!-- ./wrapper -->


<!-- MIX JS APP -->
<script src="{{ mix('js/app.js')}}"></script>
<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js')}}"></script>
</body>
</html>
