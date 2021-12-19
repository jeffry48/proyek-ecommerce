<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerHomeCtroller extends Controller
{
    public function index(){
        return view('Customer.CustomerHome');
    }
}
