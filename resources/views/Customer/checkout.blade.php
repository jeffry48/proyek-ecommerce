@extends('Customer.checkoutTemplate')
@section('content_checkout')
<div class="content-wrapper">

            <h1>CHECKOUT</h1>
            <div class="panel panel-warning" style="width: 60%">
                <div class="panel-heading">
                    <h3 class="panel-title">Rincian Kamar</h3>
                </div>
                <div class="panel-body">
                    {{-- Gambar --}}
                    <h3>{{$hotel->nama_hotel}} </h3>
                    @for ($i=0; $i<$hotel->bintang; $i+=1)
                        <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                    @endfor
                    <br>
                    {{$hotel->alamat_hotel}}, {{$hotel->daerahHotel->nama_daerah}}, {{$hotel->kotaHotel->nama_kota}}
                    <br>
                    <table>
                        <tr>
                            <td><label for="">Jenis Kamar</label> </td>
                            <td>: {{$pesanan->kamar->nama_kamar}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Harga Kamar</label></td>
                            <td>: Rp {{number_format($pesanan->kamar->harga_kamar,2,",",".")}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Jumlah Kamar yang Dipesan</label></td>
                            <td>: {{$pesanan->jumlah_kamar_pesan}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-warning" style="width: 60%" enctype="multipart/form-data">
                <div class="panel-heading">
                    <h3 class="panel-title">Tanggal Pemesanan</h3>
                </div>
                <div class="panel-body">
                    <label for="" name="tgl_checkin">Tanggal Checkin - Tanggal Checkout</label><br>
                    {{$pesanan->tgl_checkin}} - {{$pesanan->tgl_checkout}} <br>
                    <label for="" name="tgl_checkout">Total Hari</label> :
                    {{date_diff(date_create($pesanan->tgl_checkin),date_create($pesanan->tgl_checkout))->format("%a hari")}}
                </div>
            </div>
            <div class="panel panel-warning" style="width: 60%">
                <div class="panel-heading">
                    <h3 class="panel-title">Rincian Pembayaran</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td><label for="">Perhitungan :</label></td>
                        </tr>
                        <tr>
                            <td>Harga Kamar * Total Malam * Jumlah Kamar yang Dipesan</td>
                        </tr>
                    </table>
                    <br>
                    <h4>Total Pembayaran</h4>
                    <h3><b>Rp {{number_format(date_diff(date_create($pesanan->tgl_checkin),date_create($pesanan->tgl_checkout))->format("%a")*
                    $pesanan->jumlah_kamar_pesan * $pesanan->kamar->harga_kamar ,2,",",".")}}</b></h3>
                </div>
            </div>
        <form action="/pembayaran" method="post">
            @csrf
            <button type="submit" class="btn btn-default check_out" name="id_cart" value="{{$pesanan->id_cart}}">Pembayaran</button>
        </form>
    </div>
@endsection
