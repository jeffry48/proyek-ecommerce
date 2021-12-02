@extends('hotel.mainpage')
@section('content')
    <h1>EDIT PROFIL</h1>
    <form action="/userhotel/profil/" id="form" method="get">
    @isset($hotel)
        Nama Hotel
        <br><input type="text" name="namaHotel" value="{{$hotel->nama}}" id=""><br><br>
        Alamat Hotel
        <br><input type="text" name="alamatHotel" value="{{$hotel->alamat}}" id=""><br><br>
        Fasilitas
        <br>
        @foreach ($fasilitases as $fasilitas)
            <input type="checkbox" name="fasilitas[]" value="{{$fasilitas->nama}}" id=""
                @if (isset($hotel->fasilitas[$fasilitas->id]))
                    checked
                @endif
            >
            {{$fasilitas->nama}}<br>
        @endforeach
        <br>
        <br>
        nanti bisa ditambahAturan Menginap
        <br>
        Jam Check-in : <input type="time" name="jamCheckIn" value="{{$hotel->jamCheckIn}}" id=""><br>
        Jam Check-out : <input type="time" name="jamCheckOut" value="{{$hotel->jamCheckOut}}" id=""><br>
        Pembatalan dan Prabayar
        <br><input type="text" name="batalDanPrabayar" value ="{{$hotel->aturanbataldanprabayar}}" id=""><br>

        <br>
        Deskripsi
        <br><input type="text" name="deskripsiHotel" value="{{$hotel->deskripsi}}" id=""><br>
        <br>

        {{-- Gambar belum --}}
        @endisset
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
