@extends('hotel.mainpage')
@section('content')
    <h1>EDIT PROFIL</h1>
    <form action="/userhotel/profil/edit/simpan" id="form" method="post">
        @csrf
        @include('hotel.profil.isiprofil')
        <button type="submit" name="btnSimpan" id="btnSave">Simpan</button>
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
