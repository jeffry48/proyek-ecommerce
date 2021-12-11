<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function register(Request $req)
    {
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
        $hotels=DB::select('select * from hotel h');
        $pemiliks=DB::select('select * from pemilik_hotel');
        // dd($hotels);
        return view("Admin.listHotel", ['hotels'=>$hotels, 'pemiliks'=>$pemiliks]);
    }
    public function getDetailHotel($idHotel)
    {
        $currHotel=DB::select('select * from hotel h
                                where h.id_hotel="'.$idHotel.'"');
        $pemiliks=DB::select('select * from pemilik_hotel');
        $kamars=DB::select('select * from kategori_hotel where id_hotel="'.$idHotel.'"');
        return view("Admin.detailHotel", ['currHotel'=>$currHotel, 'pemiliks'=>$pemiliks, "kamars"=>$kamars]);
    }

    public function getDetailpem($idPem)
    {
        $currpem=DB::select('select * from pemilik_hotel where id_pemilik="'.$idPem.'"');
        $hotels=DB::select('select * from hotel h
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
    public function updateProfile(Request $req)
    {
        $username=$req->username;
        $pass=$req->password;
        $nama=$req->nama;
        $telp=$req->noTelp;
        DB::update('update admin set username_admin = "'.$username.'",
        password_admin = "'.$pass.'",
        nama_admin = "'.$nama.'",
        no_telp_admin = "'.$telp.'"  where id_admin = ?', [session()->get("loggedIn")]);
        return redirect("admin/profile");
    }
    public function getDetailKamar($idKamar)
    {
        $currKamar=DB::select('select * from kategori_hotel
                                where id_kategori="'.$idKamar.'"');
        $currHotel=DB::select('select * from hotel
                                where id_hotel="'.$currKamar[0]->id_hotel.'"');
        $currPem=DB::select('select * from pemilik_hotel
                            where id_pemilik="'.$currHotel[0]->id_pemilik.'"');
        return view("Admin.detailKamar", ["currKamar"=>$currKamar, "currPem"=>$currPem, "currHotel"=>$currHotel]);
    }
    public function getDetailCustomer($idCust)
    {
        $currCust=DB::select('select * from customer where id_customer="'.$idCust.'"');
        return view("Admin.detailCustomer", ["currCust"=>$currCust]);
    }
    public function searchHotel(Request $req)
    {
        $nama=$req->nama;
        $pemilik=$req->pemilik;
        $revS=$req->revS;
        $revE=$req->revE;
        $daerah=$req->daerah;
        $kota=$req->kota;
        $noTelp=$req->noTelp;
        $namaKamar=$req->namaKamar;
        $jumKS=$req->jumKS;
        $jumKE=$req->jumKE;
        $hargaKS=$req->hargaKS;
        $hargaKE=$req->hargaKE;

        if($nama==null){
            $nama="";
        }
        if($pemilik==null){
            $pemilik="";
        }
        if($revS==null){
            $revS="0";
        }
        if($revE==null){
            $revE="999999999999999999";
        }
        if($daerah==null){
            $daerah="";
        }
        if($kota==null){
            $kota="";
        }
        if($noTelp==null){
            $noTelp="";
        }
        if($namaKamar==null){
            $namaKamar="";
        }
        if($jumKS==null){
            $jumKS="0";
        }
        if($jumKE==null){
            $jumKE="999999999999999999";
        }
        if($hargaKS==null){
            $hargaKS="0";
        }
        if($hargaKE==null){
            $hargaKE="999999999999999999";
        }
        $searchResult=DB::select('select h.* from hotel h
                    join kategori_hotel k on k.id_hotel=h.id_hotel
                    join pemilik_hotel p on p.id_pemilik=h.id_pemilik
                    join kota ko on ko.id_kota=h.kota
                    join daerah d on d.id_daerah=h.daerah
                    where h.nama_hotel like "%'.$nama.'%" and
                    p.nama_pemilik like "%'.$pemilik.'%" and
                    h.bintang between "'.$revS.'" and "'.$revE.'" and
                    ko.nama_kota like "%'.$kota.'%" and
                    d.nama_daerah like "%'.$daerah.'%" and
                    ko.nama_kota like "%'.$kota.'%" and
                    h.no_telp_hotel like "%'.$noTelp.'%" and
                    k.nama_kamar like "%'.$namaKamar.'%" and
                    k.jumlah_kamar between "'.$jumKS.'" and "'.$jumKE.'" and
                    k.harga_kamar between "'.$hargaKS.'" and "'.$hargaKE.'"
                    group by h.id_hotel, h.id_pemilik, h.nama_hotel, h.bintang, h.alamat_hotel,
                    h.daerah, h.kota, h.no_telp_hotel, h.gambar_hotel, h.detail_hotel');
        $pemiliks=DB::select('select * from pemilik_hotel');
        return view("Admin.listHotel", ['hotels'=>$searchResult, 'pemiliks'=>$pemiliks]);
    }
    public function searchPemilik(Request $req)
    {
        $username=$req->username;
        $nama=$req->nama;
        $noTelp=$req->noTelp;
        $email=$req->email;
        $banned=$req->banned;

        if($username==null){
            $username="";
        }
        if($nama==null){
            $nama="";
        }
        if($noTelp==null){
            $noTelp="";
        }
        if($email==null){
            $email="";
        }
        if($banned==null){
            $banned="";
        }
        $searchResult=DB::select('select * from pemilik_hotel where
                                username_pemilik like "%'.$username.'%" and
                                nama_pemilik like "%'.$nama.'%" and
                                CAST(no_telp_pemilik as CHAR) like "%'.$noTelp.'%" and
                                email_pemilik like "%'.$email.'%" and
                                CAST(ban as CHAR) like "%'.$banned.'%"');
        // dd($searchResult);
        return view("Admin.listPemilik", ['pemiliks'=>$searchResult]);
    }
}
