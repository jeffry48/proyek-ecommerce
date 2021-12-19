<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    protected $table = "favourites";
    protected $primaryKey = "id_fav";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];
}
