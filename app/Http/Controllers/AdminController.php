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
    public function getAllDaerah()
    {
        $daerah=DB::select('select * from daerah');
        return view('Admin.listDaerah', ['daerah'=>$daerah]);
    }
    public function tambahDaerah(Request $req)
    {
        $nama=$req->daerah;
        $idk=$req->idKota;

        $cekD=DB::select("select * from daerah");
        if($cekD==null){
            DB::insert("insert into daerah values(?, ?, ?)", ["DA00000001", $nama, $idk]);
        }
        else{
            $ctrRow=DB::select('select id_daerah from daerah order by id_daerah desc');
            $lastId=substr($ctrRow[0]->id_daerah, 3);

            $lastId+=1;
            $newId="DA";
            if($lastId<10){
                $newId.="0000000";
            }
            else if($lastId>=10&&$lastId<100){
                $newId.="0000000";
            }
            else if($lastId>=100&&$lastId<1000){
                $newId.="000000";
            }
            else if($lastId>=1000&&$lastId<10000){
                $newId.="00000";
            }
            else if($lastId>=10000&&$lastId<100000){
                $newId.="0000";
            }
            else if($lastId>=100000&&$lastId<1000000){
                $newId.="000";
            }
            else if($lastId>=1000000&&$lastId<10000000){
                $newId.="00";
            }
            else if($lastId>=10000000&&$lastId<100000000){
                $newId.="0";
            }

            $newId.=$lastId;
            echo $newId;

            DB::insert("insert into daerah values(?, ?, ?)", [$newId, $nama, $idk]);
        }


        return redirect("admin/listDaerah");
    }
    public function deleteDaerah($idD)
    {
        DB::table('daerah')->where('id_daerah', '=', $idD)->delete();
        return redirect("admin/listDaerah");
    }
    public function searchDaerah(Request $req)
    {
        $namaD=$req->namaD;
        $idK=$req->idKota;

        if($namaD==null){
            $namaD="";
        }
        if($idK==null){
            $idK="KO";
        }

        $hasilSearch=DB::select("select * from daerah where
                    (nama_daerah) like ('%".$namaD."%') and
                    id_kota like '%".$idK."%'");

        return view("Admin.listDaerah", ['daerah'=>$hasilSearch]);
    }
    public function getAllKota()
    {
        $kota=DB::select('select * from kota');
        return view('Admin.listKota', ['kota'=>$kota]);
    }
    public function tambahKota(Request $req)
    {
        $namaK=$req->kota;

        $cekK=DB::select('select * from kota');
        if($cekK==null){
            DB::insert('insert into kota values(?, ?)', ['KO00000001', $namaK]);
        }
        else{
            $ctrRow=DB::select('select * from kota order by id_kota desc');
            $lastId=substr($ctrRow[0]->id_kota, 3);
            $lastId+=1;
            $newId="KO";
            if($lastId<10){
                $newId.="0000000";
            }
            else if($lastId>=10&&$lastId<100){
                $newId.="0000000";
            }
            else if($lastId>=100&&$lastId<1000){
                $newId.="000000";
            }
            else if($lastId>=1000&&$lastId<10000){
                $newId.="00000";
            }
            else if($lastId>=10000&&$lastId<100000){
                $newId.="0000";
            }
            else if($lastId>=100000&&$lastId<1000000){
                $newId.="000";
            }
            else if($lastId>=1000000&&$lastId<10000000){
                $newId.="00";
            }
            else if($lastId>=10000000&&$lastId<100000000){
                $newId.="0";
            }

            $newId.=$lastId;
            echo $newId;

            DB::insert('insert into kota values(?, ?)', [$newId, $namaK]);
        }
        return redirect('admin/listKota');
    }
    public function searchKota(Request $req)
    {
        $namaK=$req->namaK;

        if($namaK==null){
            $namaK="";
        }

        $hasilSearch=DB::select("select * from kota where
                    (nama_kota) like ('%".$namaK."%')");

        return view("Admin.listKota", ['kota'=>$hasilSearch]);
    }
    public function deleteKota($idk)
    {
        DB::table('kota')->where('id_kota', '=', $idk)->delete();
        return redirect("admin/listKota");
    }
    public function getAllTrans()
    {
        $htrans=DB::select("select * from htrans");
        return view ('Admin.laporanTrans', ['htrans'=>$htrans]);
    }
    public function searchTrans(Request $req)
    {
        $tgs=$req->tgs;
        $tge=$req->tge;

        if($tgs==null){
            $tgs="2000-01-01";
        }
        if($tge==null){
            $tge="2030-12-31";
        }

        $htrans=DB::select("select * from htrans where tgl_transaksi between '".$tgs."' and '".$tge."'");
        return view ('Admin.laporanTrans', ['htrans'=>$htrans]);
    }
    public function getAllUserbanyak()
    {
        $history=DB::select("select * from dtrans d
                            join htrans h on h.id_htrans=d.id_htrans
                            order by h.tgl_transaksi desc");
        // dd($history);
        return view ('Admin.laporanHistUser', ['history'=>$history]);
    }
    public function searchUserbanyak(Request $req)
    {
        $tgs=$req->tgs;
        $tge=$req->tge;

        if($tgs==null){
            $tgs="2000-01-01";
        }
        if($tge==null){
            $tge="2030-12-31";
        }

        $history=DB::select("select h.id_customer from htrans h
                            join dtrans d on h.id_htrans=d.id_htrans
                            where h.tgl_transaksi between '".$tgs."' and '".$tge."'
                            group by id_customer
                            ORDER BY COUNT(h.id_customer) DESC
                            LIMIT 1");

        $history2=DB::select("select * from dtrans d
                            join htrans h on h.id_htrans=d.id_htrans
                            where h.id_customer='".$history[0]->id_customer."'
                            order by h.tgl_transaksi desc");
        return view ('Admin.laporanHistUser', ['history'=>$history2]);
    }
    public function getAllpenghasilan()
    {
        $penghasilan=DB::select('select * from htrans h
        join dtrans d on h.id_htrans=d.id_htrans
        join hotel ho on ho.id_hotel=d.id_hotel
        join pemilik_hotel p on ho.id_pemilik=p.id_pemilik
        order by h.tgl_transaksi desc');

        // dd($penghasilan);
        return view("Admin.laporanPenghasilanPem", ["penghasilan"=>$penghasilan]);
    }
    public function searchPengPem(Request $req)
    {
        $tgs=$req->tgs;
        $tge=$req->tge;

        if($tgs==null){
            $tgs="2000-01-01";
        }
        if($tge==null){
            $tge="2030-12-31";
        }

        $penghasilan=DB::select("select * from dtrans d
        join htrans h on h.id_htrans=d.id_htrans
        join hotel ho on ho.id_hotel=d.id_hotel
        join pemilik_hotel p on ho.id_pemilik=p.id_pemilik
        where h.tgl_transaksi between '".$tgs."' and '".$tge."'
        order by h.tgl_transaksi desc");
        return view("Admin.laporanPenghasilanPem", ["penghasilan"=>$penghasilan]);

    }

    public function getAllPengPemBanyak()
    {
        $penghasilan=DB::select('select * from dtrans d
        join htrans h on h.id_htrans=d.id_htrans
        join hotel ho on ho.id_hotel=d.id_hotel
        join pemilik_hotel p on ho.id_pemilik=p.id_pemilik
        order by h.tgl_transaksi desc');
        return view("Admin.laporanPenghasilanPemTerbesar", ["penghasilan"=>$penghasilan]);
    }
    public function searchPengPemBanyak(Request $req)
    {
        $tgs=$req->tgs;
        $tge=$req->tge;

        if($tgs==null){
            $tgs="2000-01-01";
        }
        if($tge==null){
            $tge="2030-12-31";
        }

        $penghasilan=DB::select('select d.id_hotel from dtrans d
        join htrans h on h.id_htrans=d.id_htrans
        join hotel ho on ho.id_hotel=d.id_hotel
        join pemilik_hotel p on ho.id_pemilik=p.id_pemilik
        group by d.id_hotel
        ORDER BY COUNT(d.id_hotel) DESC
        LIMIT 1');

        $penghasilan2=DB::select('select * from dtrans d
        join htrans h on h.id_htrans=d.id_htrans
        join hotel ho on ho.id_hotel=d.id_hotel
        join pemilik_hotel p on ho.id_pemilik=p.id_pemilik
        where d.id_hotel="'.$penghasilan[0]->id_hotel.'"
        order by h.tgl_transaksi desc');
        // dd($penghasilan2);
        return view("Admin.laporanPenghasilanPemTerbesar", ["penghasilan"=>$penghasilan2]);
    }
    public function searchCustomer(Request $req)
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

        $searchCust=DB::select('select * from customer where
                                username_customer like "%'.$username.'%" and
                                nama_customer like "%'.$nama.'%" and
                                no_telp_customer like "%'.$noTelp.'%" and
                                email_customer like "%'.$email.'%" and
                                ban like "%'.$banned.'%"');

        // dd($searchCust);
        return view("Admin.listCustomer", ['customers'=>$searchCust]);
    }
    public function banCust($idCust)
    {
        DB::table('customer')
            ->where('id_customer', $idCust)
            ->update(['ban' => 1]);
            echo "updated";
        return redirect("admin/detailCust".$idCust);
    }
    public function unbanCust($idCust)
    {
        DB::table('customer')
            ->where('id_customer', $idCust)
            ->update(['ban' => 0]);
            echo "updated";
        return redirect("admin/detailCust".$idCust);
    }
    public function banPem($idPem)
    {
        DB::table('pemilik_hotel')
        ->where('id_pemilik', $idPem)
        ->update(['ban' => 1]);
        echo "updated";
    return redirect("admin/detailPem".$idPem);
    }
    public function unbanPem($idPem)
    {
        DB::table('pemilik_hotel')
        ->where('id_pemilik', $idPem)
        ->update(['ban' => 0]);
        echo "updated";
    return redirect("admin/detailPem".$idPem);
    }
}
