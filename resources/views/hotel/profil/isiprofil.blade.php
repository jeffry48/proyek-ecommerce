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
@if (!$mode_edit)
    @isset($hotel->fasilitas)
        <ul>
        @foreach ($hotel->fasilitas as $item)
            <li>{{$item->nama_fasilitas}}</li>
        @endforeach
        </ul>
    @else Tidak ada fasilitas hotel
    @endisset
@else
    @isset($fasilitas)
        @foreach ($fasilitas as $item)
            <input type="checkbox" name="fasilitas[]" id="" value="{{$item->id_fasilitas}}"
                @if ($hotel->fasilitas()->wherePivot("id_fasilitas",$item->id_fasilitas)->first())
                    checked
                @endif
            > {{$item->nama_fasilitas}}
            <br>
        @endforeach
    @endisset
@endif
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
