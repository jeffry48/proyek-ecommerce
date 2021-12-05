<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>list hotel</title>

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
    </style>
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                @include('Admin.Includes.header');
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
                                <div class="form-group">
                                    <h4>
                                        <?php
                                            use Illuminate\Support\Facades\DB;
                                            $checkUser=DB::select('select * from admin where id_admin="'.session()->get('loggedIn').'"');
                                        ?>
                                        @isset($checkUser[0]->nama_admin)
                                            Welcome, {{$checkUser[0]->nama_admin}}
                                        @endisset
                                    </h4>
                                </div>
                                <h1>List Hotel</h1>
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
                                    <form action="">
                                        <div class="box">
                                            search:
                                            <input type="text" name="" id="" class="form-control" placeholder="search">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if (isset($hotels))
                            @for ($i = 0; $i < (count($hotels)/3); $i++)
                            <div class="row">
                                @for ($j = 0; $j < 3; $j++)
                                    @if (isset($hotels[$j+(3*$i)]))
                                        <div class="col-md-4">
                                            <div class="card" id="{{$hotels[$j+(3*$i)]->id_hotel}}">
                                                <div class="card-header">
                                                    {{$hotels[$j+(3*$i)]->nama_hotel}}
                                                </div>
                                                <div class="card-body">
                                                    <div class="pic">
                                                        <img src="" alt="">
                                                    </div>
                                                    <div class="detailHotel">
                                                        @for ($k = 0; $k < count($pemiliks); $k++)
                                                            @if ($pemiliks[$k]->id_pemilik==$hotels[$j+(3*$i)]->id_pemilik)
                                                                <?php $currPem=$pemiliks[$k];?>
                                                            @endif
                                                        @endfor
                                                        by: {{$currPem->nama_pemilik}}
                                                        <br>
                                                        {{$hotels[$j+(3*$i)]->alamat_hotel}}
                                                        <br>
                                                        no telp: {{$hotels[$j+(3*$i)]->no_telp_hotel}}
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
                window.location.href="detailHotel"+$(this).attr('id');
            });
        </script>
    </body>
</html>
