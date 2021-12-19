<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HTrans extends Model
{
    protected $table = "htrans";
    protected $primaryKey = "id_htrans";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class,"id_hotel","id_hotel");
    }

    public function dtrans()
    {
        return $this->hasMany(DTrans::class);
    }
}
