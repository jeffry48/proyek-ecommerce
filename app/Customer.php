<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    protected $primaryKey = "id_customer";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];
}
