<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/dist/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/dist/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/dist/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/dist/img/favicon_io/site.webmanifest">


    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
    <!-- QR Code  -->
    {{-- <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script> --}}
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                </form>
                </div>
            </li> -->

            <!-- Messages Dropdown Menu -->
            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/client-dashboard" class="brand-link">
            {{-- <!-- <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --> --}}
            {{-- <span class="brand-text font-weight-light">{{$saas_name}} (<small style="font-weight:bolder;">V1.0.0</small>)</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img src="/dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <a href="/client-dashboard" class="d-block">'MoreCRM'</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class  with font-awesome or any other icon font library -->
                        <li class="nav-header"><strong>MAIN</strong></li>
                        <li class="nav-item">
                            <a href="/client-dashboard" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header"><strong>SETTINGS</strong></li>
                        {{-- <li class="nav-item">
                            <a href="/settings" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>General Settings</p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="/staff" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Staff</p>
                            </a>
                        </li>
                        
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>MPESA Settings</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Email Settings</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>SMS Settings</p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>