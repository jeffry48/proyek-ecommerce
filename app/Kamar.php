<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = "kategori_hotel";

    public function getPriceAttrbitue($value){
        return $value;
    }
}
