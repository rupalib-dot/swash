<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <script src="https://cdn.tiny.cloud/1/i6i6aki8vkxt19vlfxol49qa6zukk6lry8hgtzka6agthn0x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js" integrity="sha512-QMUqEPmhXq1f3DnAVdXvu40C8nbTgxvBGvNruP6RFacy3zWKbNTmx7rdQVVM2gkd2auCWhlPYtcW2tHwzso4SA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font: Source Sans Pro -->
    <script src="https://cdn.tiny.cloud/1/i6i6aki8vkxt19vlfxol49qa6zukk6lry8hgtzka6agthn0x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('public/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style type="text/css" media="all">
        .material-icons {
            position: relative;
            top: 5px;
        }

        .iti {
            width: 100%;
        }

        .text-danger {
            color: #dc3545 !important;
            margin-bottom: -13px;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="background-color: black">
            <img class="animation__shake" src="{{ asset('public/images/logo.png') }}" alt="AdminLTELogo" height="60" width="100">
        </div>

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



                <!-- Notifications Dropdown Menu -->
                {{-- {{ AdminNotifactionsShow() }} --}}

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('public/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
                <span class="brand-text font-weight-light">SwashWash</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img style="width: 40px;height: 40px;" src="{{ asset('public/dist/img/user4-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Mahesh Kumar</a>
                    </div>
                </div>

                {{-- <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MANAGE CLIENT</li>
                        <li class="nav-item">
                            <a href="{{route('client.index')}}" class="nav-link {{ Request::is('client*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    All Clients
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MANAGE LOCATIONS</li>
                        <li class="nav-item">
                            <a href="{{route('locations.index')}}" class="nav-link {{ Request::is('locations') ? 'active' : '' }}{{ Route::currentRouteName()== 'locations.edit' ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    map
                                </i>
                                <p class="text">All Locations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('locations.create')}}" class="nav-link {{ Request::is('locations/create') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    map
                                </i>
                                <p class="text">Add Location</p>
                            </a>
                        </li>
                        <li class="nav-header">MANAGE TEAMS</li>
                        <li class="nav-item">
                            <a href="{{route('teams.index')}}" class="nav-link {{ Request::is('teams') ? 'active' : '' }}{{ Route::currentRouteName()== 'teams.edit' ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    supervised_user_circle
                                </i>
                                <p class="text">All Teams Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('teams.create')}}" class="nav-link {{ Request::is('teams/create') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    supervised_user_circle
                                </i>
                                <p class="text">Add Team Member</p>
                            </a>
                        </li>
                        <li class="nav-header">MANAGE BLACK OUT DYAS</li>
                        <li class="nav-item">
                            <a href="{{route('blackout.index')}}" class="nav-link {{ Request::is('blackout') ? 'active' : '' }}{{ Route::currentRouteName()== 'blackout.edit' ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    date_range
                                </i>
                                <p class="text">All black out list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('blackout.create')}}" class="nav-link {{ Request::is('blackout/create') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    date_range
                                </i>
                                <p class="text">Add black out list</p>
                            </a>
                        </li>

                        <li class="nav-header">MANAGE COUPONS</li>
                        <li class="nav-item">
                            <a href="{{route('coupons.index')}}" class="nav-link {{ Request::is('coupons') ? 'active' : '' }}{{ Route::currentRouteName()== 'coupons.edit' ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    loyalty
                                </i>
                                <p class="text">All coupons list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('coupons.create')}}" class="nav-link {{ Request::is('coupons/create') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    loyalty
                                </i>
                                <p class="text">Add coupon</p>
                            </a>
                        </li>
                        <li class="nav-header">REFERRAL COUPONS</li>
                        <li class="nav-item">
                            <a href="{{route('referralCoupon')}}" class="nav-link {{Route::currentRouteName()== ('referralCoupon') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    loyalty
                                </i>
                                <p class="text">Referral Coupons</p>
                            </a>
                        </li>
                        <li class="nav-header">BOOKING DETAILS</li>
                        <li class="nav-item">
                            <a href="{{route('booking.index')}}" class="nav-link {{Route::currentRouteName()== ('booking') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">
                                    loyalty
                                </i>
                                <p class="text"> All Booking</p>
                            </a>
                        </li>
                        <li class="nav-header">SETTING</li>
                        <li class="nav-item">
                            <a href="{{ route('settingPage') }}" class="nav-link {{Route::currentRouteName()== ('settingPage') ? 'active' : '' }}">
                                <i class="nav-icon material-icons">settings</i>
                                <p class="text">Application Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logoutAdmin') }}" class="nav-link">
                                <i class="nav-icon material-icons">exit_to_app</i>
                                <p class="text">Logout</p>
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content')
                <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-center">
            <strong>Copyright &copy; 2021-{{ date('Y') }} <a href="#">SwashWash</a>.</strong>
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
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('public/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('public/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('public/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('public/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('public/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('public/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('public/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('public/dist/js/pages/dashboard.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('public/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- ChartJS -->

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true
                , "lengthChange": false
                , "autoWidth": false
                , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                , "ordering": false
            , }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#datatable').DataTable({
                "responsive": true
                , "lengthChange": false
                , "autoWidth": false
                , "ordering": false
            , });
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       function formatDecimal(input) {
        var val = '' + (+input.value);
        if (val) {
            val = val.split('\.');
            var out = val[0];
            while (out.length < 1) {
                out = '0' + out;
            }
            if (val[1]) {
                out = out + '.' + val[1]
                if (out.length < 1) out = out + '0';
            } else {
                out = out + '.00';
            }
            input.value = out;
        } else {
            input.value = '0.00';
        }
    }
        function showpossword(id) {
            var x = document.getElementById(id);
            var y = document.getElementById(id + '-show');
            if (x.type === "password") {
                x.type = "text";
                y.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
            } else {
                x.type = "password";
                y.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
            }
        }

    </script>
    <script>
        $(function() {
            $('#reservationdate').datetimepicker({
                format: 'L', minDate: moment().add(0, 'days')
            });
            $('#reservationdate2').datetimepicker({
                format: 'L', minDate: moment().add(0, 'days')
            });
        });

    </script>

    <script src="{{ asset('public/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });

    </script>

</body>
</html>

