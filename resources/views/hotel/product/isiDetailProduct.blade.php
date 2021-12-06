@isset($kamar)
{{-- GAMBAR BELUM --}}
    Nama Kamar
    <br><input type="text" name="namaKamar" id="" value="{{$kamar->nama_kamar}}"
        @if (!$mode_edit)
            readonly="true"
        @endif
    ><br>
    Harga Kamar
    <br><input type="text" name="hargaKamar" id="" value="{{$kamar->harga_kamar}}"
        @if (!$mode_edit)
            readonly="true"
        @endif
    ><br>
    Jumlah Kamar
    <br><input type="number" name="jmlhKamar" id="" value="{{$kamar->jumlah_kamar}}"
        @if (!$mode_edit)
            readonly="true"
        @endif
    ><br>
    Deskripsi
    <br>
    <textarea name="deskripsiKamar" id="" cols="50" rows="10"
        @if (!$mode_edit)
            readonly="true"
        @endif
    >{{$kamar->detail_kamar}}</textarea>
@endisset
