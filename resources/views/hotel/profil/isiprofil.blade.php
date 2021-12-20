<div class="card-body">
    <center>
    <img name="gmbr" src="{{asset("/hotel_images".$hotel->gambar_hotel)}}" alt="" /><br>
    <input type="hidden" name="gambar_awal" value="{{$hotel->gambar_hotel}}">
    @if ($mode_edit)
        <input type="file" name="imgfile" id="imgfile">
    @endif
    </center>
    <br>
    <div class="form-group">
        @isset($hotel)
        Nama Hotel
        <br><input type="text" class="form-control" name="namaHotel" value="{{$hotel->nama_hotel}}" id="namaHotel"
            @if (!$mode_edit)
                readonly="true"
            @endif
        >
    </div>
@if (!$mode_edit)
    Bintang
    @for ($i=0; $i<$hotel->bintang; $i+=1)
        <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
    @endfor
    <br><br>
@endif
    <div class="form-group">
        No.Telp Hotel
        <br><input type="text" class="form-control" name="noTelpHotel" value="{{$hotel->no_telp_hotel}}" id="noTelpHotel"
            @if (!$mode_edit)
                readonly="true"
            @endif
        >
    </div>
    <div class="form-group">
        Alamat Hotel
        <br><input type="text" class="form-control" name="alamatHotel" value="{{$hotel->alamat_hotel}}" id="alamatHotel"
            @if (!$mode_edit)
                readonly="true"
            @endif
        >
        <div class="container" style="margin-top: 10px">
            <div class="row align-items-start">
              <div class="col">
                <div class="input-group mb-3">
                    <span style="margin-right: 20px">Kota</span>
                    @if (!$mode_edit)
                    <input type="text" class="form-control" name="kotaHotel" value="{{$hotel->kotaHotel->nama_kota}}" id="kotaHotel" readonly="true">
                    @else
                    <select name="kota" id="cbKota" class="form-control">
                        @isset($kota)
                            @foreach ($kota as $item)
                                <option value="{{$item->id_kota}}"
                                @if ($item->id_kota == $hotel->kotaHotel->id_kota)
                                    selected
                                @endif>{{$item->nama_kota}}</option>
                            @endforeach
                        @endisset
                    </select>
                    @endif
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                    <span style="margin-right: 20px">Daerah @if ($mode_edit) di kota {{$hotel->kotaHotel->nama_kota}} @endif</span>
                    @if (!$mode_edit)
                        <input type="text" name="DaerahHotel" class="form-control" value="{{$hotel->daerahHotel->nama_daerah}}" id="DaerahHotel" readonly="true">
                    @else
                        <select id="cbDaerah" name="daerah" class="form-control">
                            @isset($daerah)
                                @foreach ($daerah as $item)
                                    <option value="{{$item->id_daerah}}"
                                        @if ($item->id_daerah == $hotel->daerahHotel->id_daerah)
                                        selected
                                    @endif>{{$item->nama_daerah}}</option>
                                @endforeach
                            @endisset
                        </select>
                    @endif
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="form-group">
    Fasilitas
    @if (!$mode_edit)
        @if(isset($hotel->fasilitas) && count($hotel->fasilitas))
            <ul>
            @foreach ($hotel->fasilitas as $item)
                <li>{{$item->nama_fasilitas}}
                @if ($item->pivot->dikenai_biaya)
                    -- Dikenai biaya tambahan
                @endif
                </li>
            @endforeach
            </ul>
        @else <br> Tidak ada fasilitas hotel
        @endif
    @else
        <br>
        @isset($fasilitas)
        <table>
            @foreach ($fasilitas as $item)
            <tr>
                <td>
                <input type="checkbox" name="fasilitas[]" id="" value="{{$item->id_fasilitas}}"
                    @if ($hotel->fasilitas()->find($item->id_fasilitas))
                        checked
                    @endif
                > {{$item->nama_fasilitas}} </td>
                <td> Dikenai biaya tambahan :
                <input type="radio" name="berbayar[{{$item->id_fasilitas}}]" value="1" id=""
                    @if ($hotel->fasilitas()->find($item->id_fasilitas))
                        @if ($hotel->fasilitas()->find($item->id_fasilitas)->pivot->dikenai_biaya==1)
                        checked
                        @endif
                    @else disabled
                    @endif
                >Ya
                <input type="radio" name="berbayar[{{$item->id_fasilitas}}]" value="0" id=""
                    @if ($hotel->fasilitas()->find($item->id_fasilitas))
                        @if ($hotel->fasilitas()->find($item->id_fasilitas)->pivot->dikenai_biaya==0)
                            checked
                        @endif
                    @else disabled checked
                    @endif
                >Tidak</td>
            </tr>
            @endforeach
        </table>
        @endisset
    @endif
    </div>
    <div class="form-group">
    {{-- Metode Pembayaran
    @if (!$mode_edit)
        @if(isset($hotel->metode_bayar) && count($hotel->metode_bayar))
            <ul>
            @foreach ($hotel->metode_bayar as $item)
                <li>{{$item->nama_metode}}</li>
            @endforeach
            </ul>
        @else <br> Belum memilih metode bayar
        @endif
    @else
        <br>
        @isset($metode_bayar)
            @foreach ($metode_bayar as $item)
                <input type="checkbox" name="metode_bayar[]" id="" value="{{$item->id_metode}}"
                    @if ($hotel->metode_bayar()->find($item->id_metode))
                        checked
                    @endif
                > {{$item->nama_metode}}
            @endforeach
        @endisset
    @endif --}}
    </div>
    <div class="form-group">
        Deskripsi
        <br>
        <textarea class="form-control" name="deskripsiHotel" id="" cols="50" rows="10"
            @if (!$mode_edit)
                readonly="true"
            @endif
        >{{$hotel->detail_hotel}}</textarea>
    </div>

{{-- Gambar belum --}}
@endisset
</div>

<script>
    $(document).ready(function(){
        $('input[name="fasilitas[]"]').change(function() {
            if(this.checked) {
                $('input[name="berbayar['+$(this).val()+']"]').attr('disabled',false);
            }else{
                $('input[name="berbayar['+$(this).val()+']"]').attr('disabled',true);
            }
        });
        $("#cbKota").change(function(){
            $.ajax({
                url: '/userhotel/getdaerahfromkota',
                type: 'get',
                dataType: 'json',
                data : {
                    kota : $("#cbKota").val()
                },
                success:function(res){
                    if(res){
                        $("#lbNamaKota").html($('select[name=kota] option:selected').text());
                        $("#cbDaerah").empty();
                        $.each(res,function(nama_daerah,id_daerah){
                            $("#cbDaerah").append('<option value="'+id_daerah+'">'+nama_daerah+'</option>');
                        });
                    }else{
                        $("#cbDaerah").empty();
                    }
                }
            });
        });
});
</script>

