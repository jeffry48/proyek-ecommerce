<?php

namespace App\Http\Controllers\Hotel;

use App\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    //HOME--
    public function viewHome()
    {
        $nama_hotel = "";
        $admin_hotel = "";
        return view("hotel.home",[
            "nama_hotel" => $nama_hotel,
            "adminhotel" => $admin_hotel
        ]);
    }
    //--HOME

    //PESANAN--
    //--PESANAN

    //PRODUCT--
    public function viewListProduct()
    {
        return view("hotel.product.listProduct");
    }
    public function viewTambahProduct()
    {
        return view("hotel.product.tambahProduct");
    }
    public function viewDetailProduct($id,Request $request)
    {
        return view("hotel.product.detailProduct");
    }
    //--PRODUCT

    //TRANSAKSI--
    public function viewListTransaksi()
    {
        return view("hotel.transaksi.listTransaksi");
    }

    public function viewDetailTransaksi($id,Request $request)
    {
        return view("hotel.transaksi.detailTransaksi");
    }
    //--TRANSAKSI

    //PROMO--
    public function viewListPromo()
    {
        return view("hotel.promo.listPromo");
    }

    public function viewDetailPromo($id,Request $request)
    {
        return view("hotel.promo.detailPromo");
    }

    public function viewTambahPromo()
    {
        return view("hotel.promo.tambahPromo");
    }
    //--PROMO

    //PROFIL--
    public function viewProfil()
    {
        $id_hotel = "HO00000001";
        $hotel = Hotel::select("*")->where("id_hotel",$id_hotel);
        $fasilitas = null;
        return view("hotel.profil.profil",[
            "mode_edit"=>false,
            "hotel"=>$hotel->first(),
            "fasilitas"=>$fasilitas
        ]);
    }
    public function viewEditProfil()
    {
        $id_hotel = "HO00000001";
        $hotel = Hotel::select("*")->where("id_hotel",$id_hotel);
        $fasilitas = null;
        return view("hotel.profil.editProfil",[
            "mode_edit"=>true,
            "hotel"=>$hotel->first(),
            "fasilitas"=>$fasilitas
        ]);
    }
    //--PROFIL
}
