@extends('hotel.mainpage')
@section('content')
    <h1>EDIT DETAIL KAMAR</h1>
    <form action="/userhotel/product/edit/simpan" method="post">
        @csrf
        @include('hotel.product.isiDetailProduct')
        <br>
        <div class="row justify-content-end"  style="margin-right: 20px;">
            <button type="submit" class="btn btn-secondary" name="btnSimpan" id="btnSave" value="{{$kamar->id_kategori}}">Simpan</button>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $("#btnSave").click(function (event) {
                if (!confirm("Apakah sudah yakin untuk menyimpan perubahan?")) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
