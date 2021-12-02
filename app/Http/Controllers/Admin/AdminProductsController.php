<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    public function displayProducts(){
        return view('Admin.displayProduct');
    }
}
