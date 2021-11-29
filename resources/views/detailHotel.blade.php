<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>detail hotel</title>

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

    </style>
    <body class="hold-transition sidebar-mini sidebar-collapse">
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

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            {{-- <a href="#" class="dropdown-item">
                                <i class="fa fa-key"></i> Logout
                            </a> --}}
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->

                <!-- Sidebar -->
                <div class="sidebar">
                    @include('sidebarLoggedIn');
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
                                <h1>{{$currHotel[0]->nama_hotel}}</h1>
                                <br>
                                <?php
                                    use Illuminate\Support\Facades\DB;
                                    $checkFav=DB::select('select * from favorite where id_kategori="'.$currHotel[0]->id_kategori.'"
                                    and id_hotel="'.$currHotel[0]->id_hotel.'" and id_customer="'.session()->get('loggedIn').'"')
                                ?>
                                @if (count($checkFav)>0)
                                    <form action="removeFavorite">
                                        <input type="hidden" name="idHotel" value="{{$currHotel[0]->id_hotel}}">
                                        <input type="hidden" name="idKategori" value="{{$currHotel[0]->id_kategori}}">
                                        <button type="submit" class="btn" id="removeFavBtn" style="background-color: red; color: white">Remove Favorite</button>
                                    </form>
                                @else
                                    <form action="addFavorite">
                                        <input type="hidden" name="idHotel" value="{{$currHotel[0]->id_hotel}}">
                                        <input type="hidden" name="idKategori" value="{{$currHotel[0]->id_kategori}}">
                                        <button type="submit" class="btn" id="favBtn" style="background-color: lightpink;">Add to Favorite</button>
                                    </form>
                                @endif

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
                                    @for ($k = 0; $k < count($pemiliks); $k++)
                                        @if ($pemiliks[$k]->id_pemilik==$currHotel[0]->id_pemilik)
                                            <?php $currPem=$pemiliks[$k];?>
                                        @endif
                                    @endfor
                                    <div class="card-body">
                                        <h4>by: {{$currPem->nama_pemilik}}</h4>
                                    </div>
                                    <div class="card-body">
                                        alamat: {{$currHotel[0]->alamat_hotel}}
                                    </div>
                                    <div class="card-body">
                                        telp: {{$currHotel[0]->no_telp_hotel}}
                                    </div>
                                    <div class="card-body">
                                        jumlah kamar: {{$currHotel[0]->jumlah_kamar}}
                                    </div>
                                    <div class="card-body">
                                        harga kamar: {{$currHotel[0]->no_telp_hotel}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" id="pesanBtn">Pesan Hotel</button>
                                <button class="btn btn-primary" id="addToCartBtn">Add to Cart</button>
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
            $('.pesanBtn').click(function() {
                window.location.href="pemesanan"+$(this).attr('');
            });
        </script>
    </body>
</html>
