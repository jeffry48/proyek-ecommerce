<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    protected $table = "metode_bayar";
    protected $primaryKey = "id_metode";
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = [];

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class,'hotel_metode_bayar','id_metode','id_hotel');
    }
}
