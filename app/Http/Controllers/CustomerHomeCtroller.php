<?php

namespace App\Http\Controllers;

use App\Favourites;
use Illuminate\Http\Request;

class CustomerHomeCtroller extends Controller
{
    public function index(){
        $favs = Favourites::join('hotel','hotel.id_hotel','=','favourites.id_hotel')
                        ->where('id_customer',session()->get('loggedIn')->id_customer)->get();
        return view('Customer.CustomerHome', compact('favs'));
    }
}
