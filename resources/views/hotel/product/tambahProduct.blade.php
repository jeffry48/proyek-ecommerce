@extends('hotel.mainpage')
@section('content')
<div class="content-wrapper">
    <form action="/userhotel/product/tambah/insert" method="post">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col">
                    <h1>TAMBAH TIPE KAMAR</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @csrf
                            Nama Kamar
                            <br><input type="text" class="form-control" name="namaKamar" id="" placeholder="Masukkan nama tipe kamar"><br>
                            Harga Kamar
                            <br><input type="text" class="form-control" name="hargaKamar" id="" placeholder="Masukkan harga tipe kamar"><br>
                            Jumlah Kamar
                            <br><input type="number" class="form-control" name="jmlhKamar" id="" placeholder="Masukkan jumlah kamar dengan tipe kamar ini"><br>
                            Deskripsi
                            <br>
                            <textarea name="deskripsiKamar" class="form-control" id="" cols="50" rows="10" placeholder="Masukkan deskripsi tipe kamar"></textarea>
                            {{-- GAMBAR BELUM --}}
                            <br>
                            <div class="row justify-content-end" style="margin-right: 5px;">
                                <button type="submit" class="btn btn-secondary" name="btnTambah" id="btnTambah">Tambah Tipe Kamar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    </form>
    <script>
        $(document).ready(function () {
            $("#btnTambah").click(function (event) {
                if (!confirm("Apakah sudah yakin untuk menambah tipe kamar ini?")) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection

