<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>detail customer</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        {{-- <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css"> --}}
        <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        {{-- <link rel="stylesheet" href="./dist/css/adminlte.min.css"> --}}
        <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/adminlte.min.css') }}">

    </head>
    <style>
        .pic{
            /* background-color: blue; */
        }
        .custom:hover{
            background-color: wheat;
            cursor: pointer;
        }
        .row{
            margin-top: 1%;
        }
    </style>
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                @include('Admin.Includes.header')
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->

                <!-- Sidebar -->
                <div class="sidebar">
                    @include('Admin.Includes.sidebarLoggedIn')
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>{{$currCust[0]->nama_customer}}</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        username: {{$currCust[0]->username_customer}}
                                    </div>
                                    <div class="card-body">
                                        nama: {{$currCust[0]->nama_customer}}
                                    </div>
                                    <div class="card-body">
                                        no telepon: {{$currCust[0]->no_telp_customer}}
                                    </div>
                                    <div class="card-body">
                                        email: {{$currCust[0]->email_customer}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($currCust[0]->ban==0)
                                    <a class="btn" href="banCust{{$currCust[0]->id_customer}}" style="background-color: red; color: white; border: solid white 1px">Ban</a>
                                @elseif ($currCust[0]->ban==1)
                                    <a class="btn" href="unbanCust{{$currCust[0]->id_customer}}" style="background-color: green; color: white; border: solid white 1px">Unban</a>
                                @endif
                            </div>
                        </div>

                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            {{-- <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.2.0-rc
                </div>
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer> --}}

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        {{-- <script src="./plugins/jquery/jquery.min.js"></script> --}}
        <script src="{{ URL::asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        {{-- <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
        <script src="{{ URL::asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- bs-custom-file-input -->
        {{-- <script src="./plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script> --}}
        <script src="{{ URL::asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <!-- AdminLTE App -->
        {{-- <script src="./dist/js/adminlte.min.js"></script> --}}
        <script src="{{ URL::asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <!-- Page specific script -->
        <script>
            $(function () {
                bsCustomFileInput.init();
            });
            $('.custom').click(function() {
                window.location.href="detailHotel"+$(this).attr('id');
            });
        </script>
    </body>
</html>
