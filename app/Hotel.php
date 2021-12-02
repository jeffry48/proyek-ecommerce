<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $table = "hotel";
    protected $primaryKey = "id_hotel";
    protected $incrementing = false;
    protected $timestamps = false;
    public $guarded = [];
}
