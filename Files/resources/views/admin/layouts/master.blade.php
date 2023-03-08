<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard - Fruits Management System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->


    <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/plugins/toastr/toastr.min.css">

    <!-- jQuery -->
    <script src="dist/js/jquery.min.js"></script>
    <style>
        .action button {
            margin-right: 5px;
            padding: 5px;
            width: 36px;
            font-size: 12px;
        }

        .mainSection,
        .content-wrapper>.content {
            padding: 15px !important;
        }

        .action {
            text-align: center;
        }

        .fruitLogoIcon {
            background: white;
            border-radius: 5px;
        }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="preloade modal fade" id="preloader" style="display: none; width:100%; height: 100%; top:0px; left:0px; z-index: 99999999999;  opacity: 0.5">
        <img id="loader" src="{{ url('dist/img/preloader.svg') }}" style="padding:21% 48% 20% ; background-color: purple; opacity: 0.9; width: 100%; height: 100% !important;" />
    </div>

    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block text-uppercase">
                    <a href="javascript:void(0);" class="nav-link">CMS - Fruits Management System</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
                        <i class="far fa-user"></i> {{ Auth::user()->name }}

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info">
                                <a href="javascript:void(0);" class="d-block">ADMIN</a>
                            </div>
                        </div>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp;{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>


                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="javascript:void(0);" class="brand-link">
                <img src="dist/img/whole-apple.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 fruitLogoIcon" />
                <span class="brand-text font-weight-light">FRUITS CMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="javascript:void(0);" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link  {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fruits') }}" class="nav-link {{ request()->is('fruits') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Fruits List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('favourites') }}" class="nav-link {{ request()->is('favourites') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Favoutites List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fruits.sync') }}" class="nav-link {{ request()->is('sync') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Sync with (Fruityvice)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    LOGOUT
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
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020-2030
                <a href="javascript:void(0);">DIGITAL APPTECH</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <!-- ./wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="dist/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/responsive.bootstrap4.min.js"></script>
    <script src="dist/js/dataTables.buttons.min.js"></script>
    <script src="dist/js/buttons.bootstrap4.min.js"></script>

    <script src="dist/plugins/toastr/toastr.min.js"></script>
    <script>
        $(function() {
            $('.toastrDefaultSuccess').click(function() {
                toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
            $('.toastrDefaultInfo').click(function() {
                toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
            $('.toastrDefaultError').click(function() {
                toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
            $('.toastrDefaultWarning').click(function() {
                toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });

        });
    </script>

</body>

</html>