<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Daerah extends Model
{
    protected $table = "daerah";

    protected $primaryKey = "id_daerah";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];

    public function kota()
    {
        return $this->HasMany(Kota::class,"id_kota","id_kota");
    }
}
