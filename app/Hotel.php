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
        return $this->hasMany(Kamar::class,"id_kategori","id_kategori");
    }

    public function fasilitas()
    {
        return $this->belongsToMany(FasilitasHotel::class,'fas_utk_hotel','id_hotel','id_fasilitas')
        ->withPivot("dikenai_biaya");
    }
}
