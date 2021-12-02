<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class user extends Controller
{
    public function register(Request $req)
    {
        if ($req->jenisUser=="customer") {
            $cekUser=DB::select('select * from customer');
            if($cekUser==null){
                DB::insert('insert into customer values (?, ?, ?, ?, ?)',
                ["CUS0001", $req->username, $req->password, $req->nama, $req->noTelp]);
            }
            else{
                $ctrRow=DB::select('select id_customer from customer order by id_customer desc');
                $lastId=substr($ctrRow[0]->id_customer, 3);

                $lastId+=1;
                $newId="CUS";
                if($lastId<10){
                    $newId.="000";
                }
                else if($lastId>=10&&$lastId<100){
                    $newId.="00";
                }
                else if($lastId>=100&&$lastId<1000){
                    $newId.="0";
                }
                $newId.=$lastId;
                // echo $newId;
                DB::insert('insert into customer values (?, ?, ?, ?, ?)',
                [$newId, $req->username, $req->password, $req->nama, $req->noTelp]);
            }
        session(['message' => "register berhasil"]);
        return redirect('register');
        }
    }
    public function login(Request $req)
    {
        if ($req->jenisUser=="customer") {
            $cekLogin=DB::select('select * from customer where username_customer="'.$req->username.'" and
            password_customer="'.$req->password.'"');
            if (count($cekLogin)>0) {
                session(['loggedIn' => $cekLogin[0]->id_customer]);
                return redirect("listHotel");
            }
            else{
                session(['errMessage' => "username/password salah"]);
                return redirect("login");
            }
        }
    }
    public function getAllFavorite()
    {
        $hotels=DB::select('select * from favorite f
                            join kategori_hotel k on f.id_kategori=k.id_kategori
                            join hotel h on k.id_hotel=h.id_hotel
                            where f.id_customer="'.session()->get('loggedIn').'"');
        $pemiliks=DB::select('select * from pemilik_hotel');
        // dd($hotels[0]->nama_hotel);
        return view("listFavorite", ['hotels'=>$hotels, 'pemiliks'=>$pemiliks]);
    }
}
