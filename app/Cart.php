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

    public function kamar()
    {
        return $this->belongsTo(Kamar::class,"id_kamar","id_kategori");
    }
}
