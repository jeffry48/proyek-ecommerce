@extends('Customer.checkoutTemplate')
@section('content_checkout')
    <div class="content-wrapper">
        <h1>PEMBAYARAN</h1>
        <form action="/bayar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="panel panel-warning" style="width: 60%">
                <div class="panel-heading">
                    <h3 class="panel-title">Rincian Pembayaran</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td><label for="">Harga Kamar</label></td>
                            <td><label for="">:</label></td>
                            <td style="float: right">Rp {{number_format($hargaKamar,2,",",".")}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Jumlah Kamar</label></td>
                            <td><label for="">:</label></td>
                            <td style="float: right">{{$jumlahKamar}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Jumlah Malam</label></td>
                            <td><label for="">:</label></td>
                            <td style="float: right">{{$jumlahMalam}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><hr style="height:2px;border-width:0;color:gray;background-color:gray"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><label style="font-size: 20px"><b>Rp {{number_format($hargaKamar,2,",",".")}}</b></label></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-warning" style="width: 60%">
                <div class="panel-heading">
                    <h3 class="panel-title">Upload Bukti Bayar</h3>
                </div>
                <div class="panel-body">
                    <p class="help-block">Silahkan masukkan foto bukti pembayaran sesuai harga</p>
                    <input type="file" name="imgfile" id="exampleInputFile">
                </div>
            </div>
            <button type="submit" class="btn btn-default check_out" id="btnBayar" name="id_cart" value="{{$id_cart}}">Bayar</button>
        </form>
        <form action="/checkout" method="post">
            @csrf
            <button type="submit" class="btn btn-default check_out" name="id_cart" value="{{$id_cart}}">Kembali ke checkout</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#btnBayar").click(function (event) {
                if (!confirm("Apakah sudah yakin untuk melakukan transaksi?")) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
