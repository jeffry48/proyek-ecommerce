@extends('hotel.mainpage')
@section('content')
    <h1>EDIT PROFIL</h1>
    <form action="/userhotel/profil/" id="form" method="get">
        @include('hotel.profil.isiprofil')
        <button type="submit" name="btnSave" id="btnSave">Simpan</button>
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
