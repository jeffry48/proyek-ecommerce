<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = "cart";
    protected $primaryKey = "id_cart";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];
}
