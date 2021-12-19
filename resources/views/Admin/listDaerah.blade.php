<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>List Daerah</title>

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
        .deleteBtn{
            background-color: red;
        }
        .deleteBtn:hover{
            cursor: pointer;
            background-color: lightcoral;
            color: black;
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
                @include('Admin.Includes.header');
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                                <h1>List Daerah</h1>
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

                        <a href="tambahDaerah" class="btn btn-primary">Tambah Daerah Baru</a>
                        <a href="listKota" class="btn btn-primary">Ke Kota</a>
                        <!-- buat search -->
                        <div class="collapse" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="searchDaerah" method="GET">
                                        <div class="box">
                                            <div class="inputBox">
                                                Nama Daerah:
                                                <input type="text" name="namaD" id="" class="form-control" placeholder="search">
                                            </div>
                                            <div class="inputBox">
                                                Nama Kota:
                                                <select name="idKota" id="" class="form-control">
                                                    <option value="">All</option>
                                                    <?php
                                                        use Illuminate\Support\Facades\DB;
                                                        $kota=DB::select('select * from kota');
                                                    ?>
                                                    @foreach ($kota as $k)
                                                        <option value="{{$k->id_kota}}">{{$k->nama_kota}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="inputBox">
                                                <input type="submit" class="btn btn-primary" value="Search Daerah">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if (isset($daerah))
                            @for ($i = 0; $i < (count($daerah)/3); $i++)
                            <div class="row">
                                @for ($j = 0; $j < 3; $j++)
                                    @if (isset($daerah[$j+(3*$i)]))
                                        <div class="col-md-4">
                                            <div class="card" id="{{$daerah[$j+(3*$i)]->id_daerah}}">
                                                <div class="card-header">
                                                    {{$daerah[$j+(3*$i)]->nama_daerah}}
                                                    @foreach ($kota as $k)
                                                        @if($k->id_kota==$daerah[$j+(3*$i)]->id_kota)
                                                            <br>
                                                            Kota: {{$k->nama_kota}}
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="card-body">
                                                    <button class="btn btn-primary deleteBtn" style="float: right;" data-toggle="modal" data-target="#exampleModal{{$daerah[$j+(3*$i)]->id_daerah}}">
                                                        Delete
                                                    </button>
                                                    <div class="modal fade" id="exampleModal{{$daerah[$j+(3*$i)]->id_daerah}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Daerah</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Hapus daerah {{$daerah[$j+(3*$i)]->nama_daerah}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a type="button" href="deleteDaerah{{$daerah[$j+(3*$i)]->id_daerah}}" class="btn btn-primary" style="background-color: red">
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
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
        </script>
    </body>
</html>
