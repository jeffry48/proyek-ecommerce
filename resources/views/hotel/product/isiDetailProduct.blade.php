<div class="card-body">
    <center>
        <img style="width: 25%; height: 25%" src="{{Storage::disk('local')->url('kamar_images/'.$kamar->gambar_kamar)}}" alt="" />                            <div class="card-body">
        <input type="hidden" name="gambar_awal" value="{{$kamar->gambar_kamar}}">
        @if ($mode_edit)
            <input type="file" name="imgfile" id="imgfile">
        @endif
        </center>
    <div class="form-group">
        @isset($kamar)
        {{-- GAMBAR BELUM --}}
            Nama Kamar
            <br><input type="text" class="form-control" name="namaKamar" id="" value="{{$kamar->nama_kamar}}"
                @if (!$mode_edit)
                    readonly="true"
                @endif
            >
    </div>
    <div class="form-group">
    Harga Kamar per Malam
    <br><input type="text" class="form-control" name="hargaKamar" id="" value="{{$kamar->harga_kamar}}"
        @if (!$mode_edit)
            readonly="true"
        @endif
    >
    </div>

    <div class="form-group">
    Jumlah Kamar yang tersedia
    <br><input type="number" class="form-control" name="jmlhKamar" id="" value="{{$kamar->jumlah_kamar}}"
        @if (!$mode_edit)
            readonly="true"
        @endif
    >
    </div>

    <div class="form-group">
    Deskripsi
    <br>
    <textarea name="deskripsiKamar" class="form-control" id="" cols="50" rows="10"
        @if (!$mode_edit)
            readonly="true"
        @endif
    >{{$kamar->detail_kamar}}</textarea>
    </div>
@endisset
</div>
