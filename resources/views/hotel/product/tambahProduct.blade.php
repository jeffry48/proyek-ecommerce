@extends('hotel.mainpage')
@section('content')
    <h1>TAMBAH TIPE KAMAR</h1>
    <form action="/userhotel/product/tambah/insert" method="post">
        @csrf
        Nama Kamar
        <br><input type="text" name="namaKamar" id="" placeholder="Masukkan nama tipe kamar"><br>
        Harga Kamar
        <br><input type="text" name="hargaKamar" id="" placeholder="Masukkan harga tipe kamar"><br>
        Jumlah Kamar
        <br><input type="number" name="jmlhKamar" id="" placeholder="Masukkan jumlah kamar dengan tipe kamar ini"><br>
        Deskripsi
        <br>
        <textarea name="deskripsiKamar" id="" cols="50" rows="10" placeholder="Masukkan deskripsi tipe kamar"></textarea>
        {{-- GAMBAR BELUM --}}
        <br>
        <button type="submit" name="btnTambah" id="btnTambah">Tambah Tipe Kamar</button>
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

