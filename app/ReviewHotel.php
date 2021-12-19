<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewHotel extends Model
{
    protected $table = "review_hotel";
    protected $primaryKey = "id_review";
    public $incrementing = false;
    public $timestamps = false;
    public $guarded = [];
}
