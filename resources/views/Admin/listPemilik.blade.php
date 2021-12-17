<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>list pemilik</title>

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
        .card:hover{
            background-color: wheat;
            cursor: pointer;
        }
        .row{
            margin-top: 1%;
        }
        .inputBox{
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
                    @include('Admin.Includes.sidebarLoggedIn');
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
                                <h1>List Pemilik</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <?php

                ?>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Search
                        </button>
                        <!-- buat search -->
                        <div class="collapse" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="searchPemilik">
                                        <div class="inputBox">
                                            nama pemilik:
                                            <input type="text" name="nama" id="" class="form-control" placeholder="">
                                        </div>
                                        <div class="inputBox">
                                            username:
                                            <input type="text" name="username" id="" class="form-control" placeholder="">
                                        </div>
                                        <div class="inputBox">
                                            no telp pemilik:
                                            <input type="text" name="noTelp" id="" class="form-control" placeholder="">
                                        </div>
                                        <div class="inputBox">
                                            email pemilik:
                                            <input type="text" name="email" id="" class="form-control" placeholder="">
                                        </div>
                                        <div class="inputBox">
                                            banned:
                                            <select name="banned" id="" class="form-control">
                                                <option value="">All</option>
                                                <option value="0">Not Banned</option>
                                                <option value="1">Banned</option>
                                            </select>
                                        </div>
                                        <div class="inputBox">
                                            <button class="btn btn-primary">Search Pemilik</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if (isset($pemiliks))
                            @for ($i = 0; $i < (count($pemiliks)/3); $i++)
                            <div class="row">
                                @for ($j = 0; $j < 3; $j++)
                                    @if (isset($pemiliks[$j+(3*$i)]))
                                        <div class="col-md-4">
                                            <div class="card" id="{{$pemiliks[$j+(3*$i)]->id_pemilik}}">
                                                <div class="card-header">
                                                    {{$pemiliks[$j+(3*$i)]->nama_pemilik}}
                                                </div>
                                                <div class="card-body">
                                                    <div class="detailHotel">
                                                        id: {{$pemiliks[$j+(3*$i)]->id_pemilik}}
                                                        <br>
                                                        username: {{$pemiliks[$j+(3*$i)]->username_pemilik}}
                                                        <br>
                                                        no telp: {{$pemiliks[$j+(3*$i)]->no_telp_pemilik}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                            @endfor
                        @endif
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
            $('.card').click(function() {
                window.location.href="detailPem"+$(this).attr('id');
            });
        </script>
    </body>
</html>
