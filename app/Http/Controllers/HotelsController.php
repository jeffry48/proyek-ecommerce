<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HotelsController extends Controller
{
    public function index(){
        $hotels = Hotel::all();

        return view("allhotels", compact("hotels"));
    }
}
