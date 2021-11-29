<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class hotels extends Controller
{
    public function getAllHotels()
    {
        $hotels=DB::select('select * from hotel h
                            join kategori_hotel k on h.id_hotel=k.id_hotel
                            where k.available=1');
        $pemiliks=DB::select('select * from pemilik_hotel');
        // dd($hotels[0]->nama_hotel);
        return view("listHotel", ['hotels'=>$hotels, 'pemiliks'=>$pemiliks]);
    }
    public function getDetailHotel($idHotel)
    {
        $currHotel=DB::select('select * from hotel h
                                join kategori_hotel k on h.id_hotel=k.id_hotel
                                where h.id_hotel="'.$idHotel.'"');
        $pemiliks=DB::select('select * from pemilik_hotel');
        return view("detailHotel", ['currHotel'=>$currHotel, 'pemiliks'=>$pemiliks]);
    }
    public function addfavorite(Request $req)
    {
        // echo $req->idKategori;
        $cekInput=DB::select('select * from favorite');
        if($cekInput==null){
            DB::insert('insert into favorite values (?, ?, ?, ?)',
            ["FAV0001", session()->get('loggedIn'), $req->idHotel, $req->idKategori]);
        }
        else{
            $ctrRow=DB::select('select id_favorite from favorite order by id_favorite desc');
            $lastId=substr($ctrRow[0]->id_favorite, 3);

            $lastId+=1;
            $newId="FAV";
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
            DB::insert('insert into favorite values (?, ?, ?, ?)',
            [$newId, session()->get('loggedIn'), $req->idHotel, $req->idKategori]);
        }
        return redirect("detailHotel".$req->idHotel);
    }
    public function removeFavorite(Request $req)
    {
        DB::table('favorite')
        ->where('id_kategori', $req->idKategori)
        ->where('id_hotel', $req->idHotel)
        ->where('id_customer', session()->get('loggedIn'))
        ->delete();
        // DB::delete('delete favorite where id_kategori="'.$req->idKategori.'"
        // and id_hotel="'.$req->idHotel.'" and id_customer="'.session()->get('loggedIn').'"');

        return redirect("detailHotel".$req->idHotel);

    }
}
