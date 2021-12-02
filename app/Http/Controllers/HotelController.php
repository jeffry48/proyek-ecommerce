<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    //HOME--
    public function viewHome()
    {
        return view("hotel.home");
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
        return view("hotel.profil.profil");
    }
    public function viewEditProfil()
    {
        return view("hotel.profil.editProfil");
    }
    //--PROFIL
}
