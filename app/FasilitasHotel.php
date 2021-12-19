<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FasilitasHotel extends Model
{
    protected $table = "fasilitas_hotel";
    protected $primaryKey = "id_fasilitas";
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = [];

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class,"fas_utk_hotel","id_fasilitas","id_hotel")
        ->withPivot("dikenai_biaya");
    }

}
