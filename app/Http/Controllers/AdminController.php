<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function register(Request $req){
        $cekAdmin=DB::select('select * from admin');
        if($cekAdmin==null){
            DB::insert('insert into admin values (?, ?, ?, ?, ?)',
            ["ADM0001", $req->username, $req->password, $req->nama, $req->noTelp]);
        }
        else{
            $ctrRow=DB::select('select id_admin from admin order by id_admin desc');
            $lastId=substr($ctrRow[0]->id_admin, 3);

            $lastId+=1;
            $newId="ADM";
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
            echo $newId;
            DB::insert('insert into admin values (?, ?, ?, ?, ?)',
            [$newId, $req->username, $req->password, $req->nama, $req->noTelp]);
        }
        session(['message' => "register admin baru berhasil"]);
        return redirect('admin/register');
    }
    public function login(Request $req)
    {
        $cekLogin=DB::select('select * from admin where username_admin="'.$req->username.'" and
        password_admin="'.$req->password.'"');
        if (count($cekLogin)>0) {
            session(['loggedIn' => $cekLogin[0]->id_admin]);
            return redirect("admin/listHotel");
        }
        else{
            session(['errMessage' => "username/password salah"]);
            return redirect("admin/login");
        }
    }
    public function getAllHotels()
    {
        $hotels=DB::select('select * from hotel h
                            join kategori_hotel k on h.id_hotel=k.id_hotel');
        $pemiliks=DB::select('select * from pemilik_hotel');
        // dd($hotels[0]->nama_hotel);
        return view("Admin.listHotel", ['hotels'=>$hotels, 'pemiliks'=>$pemiliks]);
    }
    public function getDetailHotel($idHotel)
    {
        $currHotel=DB::select('select * from hotel h
                                join kategori_hotel k on h.id_hotel=k.id_hotel
                                where h.id_hotel="'.$idHotel.'"');
        $pemiliks=DB::select('select * from pemilik_hotel');
        return view("Admin.detailHotel", ['currHotel'=>$currHotel, 'pemiliks'=>$pemiliks]);
    }
    public function getDetailpem($idPem)
    {
        $currpem=DB::select('select * from pemilik_hotel where id_pemilik="'.$idPem.'"');
        $hotels=DB::select('select * from hotel h
                            join kategori_hotel k on h.id_hotel=k.id_hotel
                            join pemilik_hotel p on p.id_pemilik=h.id_pemilik');
        return view("Admin.detailPem", ['hotels'=>$hotels, 'currPem'=>$currpem]);
    }

    public function getAllPem()
    {
        $pemiliks=DB::select('select * from pemilik_hotel');
        // dd($hotels[0]->nama_hotel);
        return view("Admin.listPemilik", ['pemiliks'=>$pemiliks]);
    }
    public function getAllCust()
    {
        $customers=DB::select('select * from customer');
        // dd($hotels[0]->nama_hotel);
        return view("Admin.listCustomer", ['customers'=>$customers]);
    }
}
