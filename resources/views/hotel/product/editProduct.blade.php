@extends('hotel.mainpage')
@section('content')
    <h1>EDIT DETAIL KAMAR</h1>
    <form action="/userhotel/product/edit/simpan" method="post">
        @csrf
        @include('hotel.product.isiDetailProduct')
        <button type="submit" name="btnSimpan" id="btnSave" value="{{$kamar->id_kategori}}">Simpan</button>
    </form>
    <script>
        $(document).ready(function () {
            $("#btnSave").click(function (event) {
                if (confirm("Apakah sudah yakin untuk menyimpan perubahan?")) {
                    alert("Berhasil disimpan");
                } else {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
