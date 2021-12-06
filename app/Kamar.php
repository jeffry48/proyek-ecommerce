<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = "kategori_hotel";
    protected $primaryKey = "id_kategori";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function hotel()
    {
        return $this->hasMany(Hotel::class,"id_hotel","id_hotel");
    }

    public function getPriceAttrbitue($value){
        return $value;
    }
}
