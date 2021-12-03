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
}
