<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Favourites;
use App\PemilikHotel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class user extends Controller
{
    public function register(Request $req)
    {
        $error = "";
        $cekCustomer = Customer::where('username_customer',$req->username)->get();
        if($cekCustomer->count()>0){
            $error = "username sudah terpakai";
        }else{
            $ctrRow = Customer::where('no_telp_customer','>',0)->get();
            $lastId=substr($ctrRow[0]->id_customer, 3);
            $lastId+=1;
            $newId="CUS";
            if($lastId<10){
                $newId.="000000";
            }
            else if($lastId>=10&&$lastId<100){
                $newId.="00000";
            }
            else if($lastId>=100&&$lastId<1000){
                $newId.="0000";
            }
            $newId.=$lastId;

            if($req->password == $req->confirm){
                $newCustomer = new Customer;
                $newCustomer->id_customer = $newId;
                $newCustomer->username_customer = $req->username;
                $newCustomer->password_customer = $req->password;
                $newCustomer->nama_customer = $req->nama;
                $newCustomer->no_telp_customer = $req->noTelp;
                $newCustomer->email_customer = $req->email;
                if($req->jenisUser=="customer"){
                    $newCustomer->tipe_customer = 0;
                }else{
                    $newCustomer->tipe_customer = 1;
                }
                $newCustomer->save();
            }else{
                $error = "password tidak sama dengan confirm password";
            }
        }
        if($error == ""){
            return redirect("login");
        }else{
            session(['message' => $error]);
            return redirect('register');
        }
    }


    public function login(Request $req)
    {
        if($req->jenisUser=="customer"){
            $jeniscustomer = 0;
        }else{
            $jeniscustomer = 1;
        }

        $cekLogin = Customer::where('username_customer',$req->username)
                        ->where('password_customer',$req->password)
                        ->where('ban',0)
                        ->get();
        if($cekLogin->count()>0){
            session(['loggedIn' => $cekLogin[0]]);
            return redirect('hotel');
            //ini buat login ke penyewa
        }else{
            session(['errMessage' => "username/password salah"]);
            return redirect("login");
        }
    }

    public function logout(){
        session()->forget('loggedIn');
        return redirect('login');
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

    public function getProfile(){
        return view('Customer.profile');
    }

    public function editProfile(){
        return view('Customer.editProfile');
    }

    public function prosesEditProfile(Request $req){
        $nama = $req->input('nama');
        $no_telp = $req->input('no_telp');
        $email = $req->input('email');
        $id = session()->get('loggedIn')->id_customer;

        $updateProfile = Customer::where('id_customer',$id)->first();
        $updateProfile->nama_customer = $nama;
        $updateProfile->no_telp_customer = $no_telp;
        $updateProfile->email_customer = $email;
        $updateProfile->save();

        session()->forget('loggedIn');
        session(['loggedIn' => $updateProfile]);

        return view('Customer.profile');
    }

    public function getFavourite(){
        $favs = Favourites::where('id_customer',session()->get('loggedIn')->id_customer)
                                ->join('hotel','hotel.id_hotel','=','favourites.id_hotel')
                                ->join('kota','kota.id_kota','=','hotel.Kota')
                                ->join('daerah','daerah.id_daerah','=','hotel.Daerah')
                                ->get();

        return view('Customer.favourite', compact('favs'));
    }

    public function sendLetter(Request $req){

    }
}
