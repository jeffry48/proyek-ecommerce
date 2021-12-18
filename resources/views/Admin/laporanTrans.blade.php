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
        .inputBox{
            margin-top: 1%;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        th
        {
            background-color: white;
        }
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }
        .totals{
            text-align: right;
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
                                <?php
                                    use Illuminate\Support\Facades\DB;
                                ?>
                                <h1>Laporan Transaksi</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
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
                                    <form action="searchTrans" method="get">
                                        <div class="box">
                                            <div class="col-sm-12" style="float: left">
                                                <div class="inputBox">
                                                    tanggal mulai:
                                                    <input type="date" name="tgs" id="" class="form-control" placeholder="">
                                                </div>
                                                <div class="inputBox">
                                                    tanggal akhir:
                                                    <input type="date" name="tge" id="" class="form-control" placeholder="">
                                                </div>

                                                <div class="inputBox">
                                                    <button class="btn btn-primary">search transaksi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if (isset($htrans))
                            <table>
                                <thead>
                                    <tr>
                                        <th>id transaksi</th>
                                        <th>nama customer</th>
                                        <th>tanggal transaksi</th>
                                        <th>total</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($htrans); $i++)
                                        <tr>
                                            <td>{{$htrans[$i]->id_htrans}}</td>
                                            <?php
                                                $namaCust=DB::select('select * from customer where id_customer="'.$htrans[$i]->id_customer.'"');
                                            ?>
                                            <td>{{$namaCust[0]->nama_customer}}</td>
                                            <td>{{$htrans[$i]->tgl_transaksi}}</td>
                                            <td class="totals">Rp {{number_format($htrans[$i]->total_harga, 0, ".", ".")}}</td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$htrans[$i]->id_htrans}}">Detail</button>
                                                <div class="modal fade" id="exampleModal{{$htrans[$i]->id_htrans}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>nama kamar</th>
                                                                        <th>nama hotel</th>
                                                                        <th>jumlah kamar</th>
                                                                        <th>tanggal check in</th>
                                                                        <th>tanggal check out</th>
                                                                        <th>harga kamar</th>
                                                                        <th>subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                        $dtrans=DB::select('select * from dtrans where id_htrans="'.$htrans[$i]->id_htrans.'"');
                                                                    ?>
                                                                    @foreach ($dtrans as $d)
                                                                        <tr>
                                                                            <?php
                                                                                $kamar=DB::select('select * from kategori_hotel where id_kategori="'.$d->id_kategori.'"');
                                                                            ?>
                                                                            <td>{{$kamar[0]->nama_kamar}}</td>
                                                                            <?php
                                                                                $hotel=DB::select('select * from hotel where id_hotel="'.$d->id_hotel.'"');
                                                                            ?>
                                                                            <td>{{$hotel[0]->nama_hotel}}</td>
                                                                            <td>{{$d->jumlah_kamar}}</td>
                                                                            <td>{{$d->tgl_checkin}}</td>
                                                                            <td>{{$d->tgl_checkout}}</td>
                                                                            <td class="totals">Rp {{number_format($kamar[0]->harga_kamar, 0, ".", ".")}}</td>
                                                                            <td class="totals">Rp {{number_format($d->subtotal, 0, ".", ".")}}</td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
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
