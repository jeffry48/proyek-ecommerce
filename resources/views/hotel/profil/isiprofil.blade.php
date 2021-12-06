@isset($hotel)
Nama Hotel
<br><input type="text" name="namaHotel" value="{{$hotel->nama_hotel}}" id="namaHotel"
    @if (!$mode_edit)
        readonly="true"
    @endif
><br><br>
No.Telp Hotel
<br><input type="text" name="noTelpHotel" value="{{$hotel->no_telp_hotel}}" id="noTelpHotel"
    @if (!$mode_edit)
        readonly="true"
    @endif
><br><br>
Alamat Hotel
<br><input type="text" name="alamatHotel" value="{{$hotel->alamat_hotel}}" id="alamatHotel"
    @if (!$mode_edit)
        readonly="true"
    @endif
><br><br>
Fasilitas
<br>
@isset($fasilitas)
    @foreach ($fasilitas as $fasilitas)
        <input type="checkbox" name="fasilitas[]" value="{{$fasilitas->nama}}" id=""
            @if (isset($hotel->fasilitas[$fasilitas->id]))
                checked
            @endif
            @if (!$mode_edit)
                readonly="true"
            @endif
        >
        {{$fasilitas->nama}}<br>
    @endforeach
@else Tidak ada fasilitas hotel
@endisset
<br>
<br>

{{-- misal ada aturan menginap --}}
{{-- Aturan Menginap
<br>
Jam Check-in : <input type="time" name="jamCheckIn" value="{{$hotel->jamCheckIn}}" id=""><br>
Jam Check-out : <input type="time" name="jamCheckOut" value="{{$hotel->jamCheckOut}}" id=""><br>
Pembatalan dan Prabayar
<br><input type="text" name="batalDanPrabayar" value ="{{$hotel->aturanbataldanprabayar}}" id=""><br> --}}

<br>
Deskripsi
<br>
<textarea name="deskripsiHotel" id="" cols="50" rows="10"
    @if (!$mode_edit)
        readonly="true"
    @endif
>{{$hotel->detail_hotel}}</textarea>
<br>
<br>

{{-- Gambar belum --}}
@endisset
