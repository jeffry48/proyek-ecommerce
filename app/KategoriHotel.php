<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriHotel extends Model
{
    // jenis kamar
    protected $table = "kategori_hotel";
    protected $primaryKey = "id_kategori";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function hotel()
    {
        return $this->hasMany(Hotel::class,"id_hotel","id_hotel");
    }
}
