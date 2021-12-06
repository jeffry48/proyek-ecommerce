<?php

namespace App\Http\Controllers\Hotel;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\KategoriHotel;
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
        $id_hotel = "HO00000001";
        $tipe_kamar = KategoriHotel::select("*")->where("id_hotel", $id_hotel);
        return view("hotel.product.listProduct",[
            "products"=>$tipe_kamar->get()
        ]);
    }
    public function viewTambahProduct()
    {
        return view("hotel.product.tambahProduct");
    }
    public function viewDetailProduct($id,Request $request)
    {
        $tipe_kamar = KategoriHotel::select("*")->where("id_kategori",$id);
        return view("hotel.product.detailProduct",[
            "mode_edit"=>false,
            "kamar"=>$tipe_kamar->first()
        ]);
    }
    public function viewEditProduct($id,Request $request)
    {
        $tipe_kamar = KategoriHotel::select("*")->where("id_kategori",$id);
        return view("hotel.product.editProduct",[
            "mode_edit"=>true,
            "kamar"=>$tipe_kamar->first()
        ]);
    }
    public function simpanEditProduct(Request $request)
    {
        $id_kategori = $request->btnSimpan;
        return redirect('/userhotel/product/'.$id_kategori);
    }
    public function viewTambahJmlhProduct($id,Request $request)
    {
        return back();
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
    public function simpanEditProfil(Request $request)
    {
        return redirect('/userhotel/profil');
    }
    //--PROFIL
}
