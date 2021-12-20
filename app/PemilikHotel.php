<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemilikHotel extends Model
{
    protected $table = "pemilik_hotel";
    protected $primaryKey = "id_pemilik";
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = [];
}
