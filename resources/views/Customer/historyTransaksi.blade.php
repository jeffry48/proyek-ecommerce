@extends('layouts.index');
@section('center')

<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="/customerHome" class="active">Home</a></li>
                        <li><a href="/hotel" class="active">Hotel</a></li>
                        <li class="dropdown"><a href="#">Account<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="/profile">My Profile</a></li>
                                <li><a href="/favourite">My Favourite</a></li>
                                <li><a href="/history">My History</a></li>
                            </ul>
                        </li>

                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-sm-3">
                <div class="search_box pull-right">
                    <input type="text" placeholder="Search"/>
                </div>
            </div> --}}
        </div>
    </div>
</div><!--/header-bottom-->
</header><!--/header-->

<section>
    <center>
        <div class="container">
            <h3>History Transaksi</h3>
            <table style="border:1px solid black" class="table table-sm table-bordered">
                <thead class="table-light">
                    <th style="border:1px solid black">Tanggal Transaksi</th>
                    <th style="border:1px solid black">Nama Hotel</th>
                    <th style="border:1px solid black">Jenis Kamar</th>
                    <th style="border:1px solid black">Jumlah Kamar</th>
                    <th style="border:1px solid black">Total Harga</th>
                    <th style="border:1px solid black">Jenis Pembayaran</th>
                </thead>
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td style="border:1px solid black">{{$transaksi->tgl_transaksi}}</td>
                        <td style="border:1px solid black">{{$transaksi->nama_hotel}} </td>
                        <td style="border:1px solid black">{{$transaksi->nama_kamar}}</td>
                        <td style="border:1px solid black">{{$transaksi->jumlah_kamar}}</td>
                        <td style="border:1px solid black">{{$transaksi->subtotal}}</td>
                        <td style="border:1px solid black">{{$transaksi->metode_bayar}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </center>
</section>

<br><br><br><br>




@endsection
