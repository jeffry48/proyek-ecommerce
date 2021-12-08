<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $table = "hotel";
    protected $primaryKey = "id_hotel";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function tipe_kamar()
    {
        return $this->hasMany(Kamar::class);
    }

    public function kotaHotel()
    {
        return $this->belongsTo(Kota::class,"Kota","id_kota");
    }

    public function daerahHotel()
    {
        return $this->belongsTo(Daerah::class,"Daerah","id_daerah");
    }

    public function fasilitas()
    {
        return $this->belongsToMany(FasilitasHotel::class,'fas_utk_hotel','id_hotel','id_fasilitas')
        ->withPivot("dikenai_biaya");
    }
}
