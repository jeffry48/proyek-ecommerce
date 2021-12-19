<?php

namespace App\Http\Controllers;

use App\Daerah;
use App\FasilitasHotel;
use App\Favourites;
use App\Hotel;
use App\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HotelsController extends Controller
{
    public function index(){
        $hotels = Hotel::all();
        $kotas = Kota::all();
        $listfavs = array();
        if(session()->get('loggedIn')){
            $listfavs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)->get();
        }
        $favs = array();
        foreach ($listfavs as $fav) {
            array_push($favs,$fav->id_hotel);
        }
        $fasilitass = FasilitasHotel::all();

        return view("Customer.allhotels", compact("hotels","kotas","favs","fasilitass"));
    }

    public function filterHotel(Request $req, $id){
        $hotels = Hotel::where('Kota',$id)->get();
        $kotas = Kota::all();
        $daerahs = Daerah::where('id_kota',$id)->get();
        $listfavs = array();
        if(session()->get('loggedIn')){
            $listfavs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)->get();
        }
        $favs = array();
        foreach ($listfavs as $fav) {
            array_push($favs,$fav->id_hotel);
        }
        $fasilitass = FasilitasHotel::all();

        return view("Customer.allhotels", compact("hotels","kotas","daerahs","favs","fasilitass"));
    }

    public function filterFasilitas(Request $req){
        $ada = false;
        $hotels = Hotel::where('bintang','>',0)
                        ->join('fas_utk_hotel','fas_utk_hotel.id_hotel','=','hotel.id_hotel');
        if($req->input('1')){
            $hotels = $hotels->where('id_fasilitas','1');
            $ada = true;
        }
        if($req->input('2')){
            $hotels = $hotels->where('id_fasilitas','2');
            $ada = true;
        }
        if($req->input('3')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','3');
        }
        if($req->input('4')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','4');
        }
        if($req->input('5')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','5');
        }
        if($req->input('6')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','6');
        }
        if($req->input('7')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','7');
        }
        if($req->input('8')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','8');
        }
        if($req->input('9')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','9');
        }
        if($req->input('10')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','10');
        }
        if($req->input('11')){
            $ada = true;
            $hotels = $hotels->where('id_fasilitas','11');
        }

        if($ada){
            $hotels = $hotels->get();
        }else{
            $hotels = Hotel::all();
        }

        $kotas = Kota::all();
        $listfavs = array();
        if(session()->get('loggedIn')){
            $listfavs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)->get();
        }
        $favs = array();
        foreach ($listfavs as $fav) {
            array_push($favs,$fav->id_hotel);
        }
        $fasilitass = FasilitasHotel::all();

        return view("Customer.allhotels", compact("hotels","kotas","favs","fasilitass"));
    }

    public function searchHotel(Request $req){
        $nama = $req->input('nama');
        $hotels = Hotel::where('nama_hotel','like','%'.$nama.'%')->get();
        $kotas = Kota::all();
        $listfavs = array();
        if(session()->get('loggedIn')){
            $listfavs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)->get();
        }
        $favs = array();
        foreach ($listfavs as $fav) {
            array_push($favs,$fav->id_hotel);
        }
        $fasilitass = FasilitasHotel::all();

        return view("Customer.allhotels", compact("hotels","kotas","favs","fasilitass"));
    }

    public function filterDaerah(Request $req, $id){
        $hotels = Hotel::where('Daerah',$id)->get();
        $kotas = Kota::all();

        return view("Customer.allhotels", compact("hotels","kotas"));
    }

    public function tambahFav(Request $req, $id){
        $fav = new Favourites();
        $fav->id_customer = session()->get('loggedIn')->id_customer;
        $fav->id_hotel = $id;
        $fav->save();

        $hotels = Hotel::all();
        $kotas = Kota::all();
        $listfavs = array();
        if(session()->get('loggedIn')){
            $listfavs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)->get();
        }
        $favs = array();
        foreach ($listfavs as $fav) {
            array_push($favs,$fav->id_hotel);
        }
        $fasilitass = FasilitasHotel::all();

        return view("Customer.allhotels", compact("hotels","kotas","favs","fasilitass"));
    }

    public function removeFav(Request $req, $id){
        $fav = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)
                        ->where('id_hotel',$id);
        $fav->delete();

        $hotels = Hotel::all();
        $kotas = Kota::all();
        $listfavs = array();
        if(session()->get('loggedIn')){
            $listfavs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)->get();
        }
        $favs = array();
        foreach ($listfavs as $fav) {
            array_push($favs,$fav->id_hotel);
        }
        $fasilitass = FasilitasHotel::all();

        return view("Customer.allhotels", compact("hotels","kotas","favs","fasailitass"));

    }

}
