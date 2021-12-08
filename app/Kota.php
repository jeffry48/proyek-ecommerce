<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = "kota";
    protected $primaryKey = "id_kota";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }
}
