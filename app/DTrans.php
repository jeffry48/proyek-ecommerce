<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DTrans extends Model
{
    protected $table = "dtrans";
    protected $primaryKey = "id_dtrans";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function htrans()
    {
        return $this->belongsTo(HTrans::class,"id_htrans","id_htrans");
    }


}
