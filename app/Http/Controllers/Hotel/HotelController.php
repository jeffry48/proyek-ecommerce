<?php

namespace App\Http\Controllers\Hotel;

use App\Daerah;
use App\DTrans;
use App\FasilitasHotel;
use App\Hotel;
use App\HTrans;
use App\Http\Controllers\Controller;
use App\Kamar;
use App\KategoriHotel;
use App\Kota;
use App\MetodeBayar;
use App\PemilikHotel;
use Exception;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class HotelController extends Controller
{
    public function viewLogin(Request $request)
    {
        return view("hotel.loginHotel");
    }
    public function login(Request $request)
    {
        $cekLogin = PemilikHotel::select("*")->where("username_pemilik",$request->username)
            ->where('password_pemilik',$request->password)->where('ban',0)->first();
        if($cekLogin!=null){
            session(['adminHotelLoggin' => $cekLogin]);
            return redirect("/userhotel/pilihhotel");
        }else{
            return back()->with('alert',"Username/Password salah");
        }
    }
    public function viewRegister(Request $request)
    {
        return view("hotel.registerHotel");
    }

    public function generateIdPemilik()
    {
        $kode = "PE";
        $idmaks = PemilikHotel::max('id_pemilik');
        $index = ((int)substr($idmaks,2))+1;
        $kode .= str_pad($index,8,'0',STR_PAD_LEFT);
        return $kode;
    }

    public function register(Request $request)
    {
        $pemilik = [
            "id_pemilik" => $this->generateIdPemilik(),
            "username_pemilik" => $request->username,
            "password_pemilik" => $request->password,
            "nama_pemilik" => $request->nama,
            "no_telp_pemilik" => $request->noTelp
        ];
        PemilikHotel::create($pemilik);
        return redirect("/userhotel/login");
    }

    public function viewPilihHotel(Request $request)
    {
        $admin_hotel = session()->get('adminHotelLoggin');
        $hotel = Hotel::select('*')->where("id_pemilik",$admin_hotel->id_pemilik)->get();
        return view("hotel.listHotel",[
            "hotel"=>$hotel
        ]);
    }

    public function setHotel(Request $request)
    {
        session(['hotelLoggin' => $request->id_hotel]);
        return redirect("userhotel/");
    }

    public function logout()
    {
        session()->forget('adminHotelLoggin');
        session()->forget('hotelLoggin');
        return redirect('userhotel/login');
    }
    //HOME--
    public function viewHome()
    {
        $admin_hotel = session()->get('adminHotelLoggin');
        $id_hotel = session()->get('hotelLoggin');
        $hotel = Hotel::select("*")->where("id_hotel",$id_hotel);
        return view("hotel.home",[
            "adminhotel" => $admin_hotel,
            "hotel" => $hotel->first()
        ]);
    }

    public function getTransaksiDatangToday(Request $request)
    {
        $id_hotel = "HO00000003";
        $today = date("Y-m-d");
        $htrans_hotel = HTrans::select("id_hotel",$id_hotel)->get();
        $dtrans_checkin_today = $htrans_hotel->dtrans()->where("tgl_checkin",$today)->get();
    }
    //--HOME

    //PESANAN--
    //--PESANAN

    //PRODUCT--
    public function viewListProduct()
    {
        $id_hotel = session()->get('hotelLoggin');
        $tipe_kamar = Kamar::select("*")->where("id_hotel", $id_hotel);
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
        $tipe_kamar = Kamar::select("*")->where("id_kategori",$id);
        return view("hotel.product.detailProduct",[
            "mode_edit"=>false,
            "kamar"=>$tipe_kamar->first()
        ]);
    }
    public function viewEditProduct($id,Request $request)
    {
        $tipe_kamar = Kamar::select("*")->where("id_kategori",$id);
        return view("hotel.product.editProduct",[
            "mode_edit"=>true,
            "kamar"=>$tipe_kamar->first()
        ]);
    }
    public function simpanEditProduct(Request $request)
    {
        $id_kategori = $request->btnSimpan;
        $nama_kamar = $request->namaKamar;
        $harga_kamar = $request->hargaKamar;
        $jmlh_kamar = $request->jmlhKamar;
        $deskripsi_kamar = $request->deskripsiKamar;
        $imgfile = $request->file('imgfile');
        $filename = "";

        if ($request->hasFile('imgfile')) {
            $imgfile = $request->file('imgfile');
            if($request->hasFile('imgfile')){
                $filename = pathinfo($imgfile->getClientOriginalName(), PATHINFO_FILENAME).".".$imgfile->getClientOriginalExtension();
                // $imgfile->storeAs("public/images/hotel_images", $filename);
                Storage::putFileAs(
                    'public/kamar_images',
                    $request->file("imgfile"),
                    $filename
                );
            }
        }else{
            $filename = $request->gambar_awal;
        }

        try {
            Kamar::where('id_kategori',$id_kategori)
            ->update([
                'nama_kamar'=>$nama_kamar,
                'harga_kamar'=>$harga_kamar,
                'jumlah_kamar'=>$jmlh_kamar,
                'detail_kamar'=>$deskripsi_kamar,
                "gambar_kamar" => $filename
            ]);
            return redirect('/userhotel/product/'.$id_kategori)->with('alert','Perubahan berhasil disimpan');
        } catch (Exception $e) {
            return back()->with('alert',$e->getMessage());
        }
    }
    public function tambahProduct(Request $request)
    {
        $id_hotel = session()->get('hotelLoggin');
        $nama_kamar = $request->namaKamar;
        $harga_kamar = $request->hargaKamar;
        $jmlh_kamar = $request->jmlhKamar;
        $deskripsi_kamar = $request->deskripsiKamar;
        $imgfile = $request->file('imgfile');
        $filename = "";

        if ($request->hasFile('imgfile')) {
            $imgfile = $request->file('imgfile');
            if($request->hasFile('imgfile')){
                $filename = pathinfo($imgfile->getClientOriginalName(), PATHINFO_FILENAME).".".$imgfile->getClientOriginalExtension();
                // $imgfile->storeAs("public/images/hotel_images", $filename);
                Storage::putFileAs(
                    'public/kamar_images',
                    $request->file("imgfile"),
                    $filename
                );
            }
        }
        try {
            $kamar_baru = [
                "id_kategori" => $this->generateKodeKamar($id_hotel),
                "id_hotel" => $id_hotel,
                "nama_kamar" => $nama_kamar,
                "harga_kamar" => $harga_kamar,
                "jumlah_kamar" => $jmlh_kamar,
                "detail_kamar" => $deskripsi_kamar,
                "gambar_kamar" => $filename
            ];
            Kamar::create($kamar_baru);
            return redirect('/userhotel/product')->with('alert','Tipe kamar berhasil ditambah');
        }  catch (Exception $e) {
            return back()->with('alert',$e->getMessage());
        }
    }
    public function generateKodeKamar($id_hotel)
    {
        $kode = "KA";
        $idmaks = Kamar::max('id_kategori');
        $index = ((int)substr($idmaks,2))+1;
        $kode .= str_pad($index,8,'0',STR_PAD_LEFT);
        return $kode;
    }
    public function hapusProduct(Request $request)
    {
        $id_kamar_dihapus = $request->btnHapus;
        try {
            Kamar::find($id_kamar_dihapus)->delete();
            return redirect('/userhotel/product')->with('alert','Tipe kamar berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('alert',$e->getMessage());
        }
    }
    //--PRODUCT

    //TRANSAKSI--
    public function viewListTransaksi(Request $request)
    {
        $id_hotel = session()->get('hotelLoggin');
        $dtrans = DTrans::select("*")->where("id_hotel",$id_hotel);
        return view("hotel.transaksi.listTransaksi",[
            "htrans" => $dtrans->get()
        ]);
    }

    public function viewDetailTransaksi(Request $request)
    {
        $id_htrans = $request->id_htrans;
        $htrans = HTrans::select("*")->where("id_htrans",$id_htrans);
        return view("hotel.transaksi.detailTransaksi",[
            "htrans" => $htrans->first()
        ]);
    }
    //--TRANSAKSI

    //PROFIL--
    public function viewProfil()
    {
        $id_hotel = session()->get('hotelLoggin');
        $hotel = Hotel::select("*")->where("id_hotel",$id_hotel);
        return view("hotel.profil.profil",[
            "mode_edit"=>false,
            "hotel"=>$hotel->first()
        ]);
    }
    public function getDaerahfromKota(Request $request)
    {
        $id_kota_selected = "";
        if(isset($request->kota)){
            $id_kota_selected = $request->kota;
        }
        $daerah = Daerah::where("id_kota",$id_kota_selected)->pluck("id_daerah","nama_daerah");
        return response()->json($daerah);
    }
    // public function getKotafromDaerah(Request $request)
    // {
    //     $id_daerah_selected = "";
    //     if(isset($request->daerah)){
    //         $id_daerah_selected = $request->daerah;
    //     }
    //     $kota = Daerah::where("id_daerah",$id_daerah_selected)->kota->pluck("id_kota","nama_kota");
    //     return response()->json($kota);
    // }
    public function viewEditProfil(Request $request)
    {
        $id_hotel = session()->get('hotelLoggin');
        //$metode_bayar = MetodeBayar::select("*");
        $kota = Kota::select("*");
        $hotel = Hotel::select("*")->where("id_hotel",$id_hotel);
        $id_kota_selected = $hotel->first()->kotaHotel->id_kota;
        $daerah = Daerah::where("id_kota",$id_kota_selected);
        $fasilitas = FasilitasHotel::select("*");
        return view("hotel.profil.editProfil",[
            "mode_edit"=>true,
            "hotel"=>$hotel->first(),
            "fasilitas"=>$fasilitas->get(),
            "kota" => $kota->get(),
            "daerah" => $daerah->get()
            //"metode_bayar" => $metode_bayar->get()
        ]);
    }
    public function simpanEditProfil(Request $request)
    {
        $id_hotel = session()->get('hotelLoggin');
        $nama_hotel = $request->namaHotel;
        $id_kota = $request->kota;
        $id_daerah = $request->daerah;
        $no_telp_hotel = $request->noTelpHotel;
        $alamat_hotel = $request->alamatHotel;
        $deskripsi_hotel = $request->deskripsiHotel;
        $arrfasilitas = $request->fasilitas;
        $arrberbayar = $request->berbayar;
        $imgfile = $request->file('imgfile');
        $filename = "";

        if ($request->hasFile('imgfile')) {
            $imgfile = $request->file('imgfile');
            if($request->hasFile('imgfile')){
                $filename = pathinfo($imgfile->getClientOriginalName(), PATHINFO_FILENAME).".".$imgfile->getClientOriginalExtension();
                // $imgfile->storeAs("public/images/hotel_images", $filename);
                Storage::putFileAs(
                    'public/hotel_images',
                    $request->file("imgfile"),
                    $filename
                );
            }
        }else{
            $filename = $request->gambar_awal;
        }
        //$arrmetodebayar = $request->metode_bayar;
        try {
            $hotel = Hotel::where("id_hotel",$id_hotel)->first();
            $data_fasilitas = [];
            for ($i=0; $i < count($arrfasilitas); $i++) {
                $data_fasilitas[$arrfasilitas[$i]]=[
                    "id_fas_hotel" => "FH".substr($id_hotel,3).str_pad(($i+1),3,"0",STR_PAD_LEFT),
                    "dikenai_biaya"=>(int)$arrberbayar[$arrfasilitas[$i]]
                ];
            }
            $hotel->fasilitas()->sync($data_fasilitas);
            // $data_metode_bayar = [];
            // for ($i=0; $i < count($arrmetodebayar); $i++) {
            //     $data_metode_bayar[$arrmetodebayar[$i]]=[
            //         "id_hotel_metode" => "MBH".substr($id_hotel,3).str_pad(($i+1),2,"0",STR_PAD_LEFT)
            //     ];
            // }
            // $hotel->metode_bayar()->sync($data_metode_bayar);
            Hotel::where('id_hotel',$id_hotel)->update([
                "nama_hotel" => $nama_hotel,
                "no_telp_hotel"=>$no_telp_hotel,
                "alamat_hotel" => $alamat_hotel,
                "detail_hotel" => $deskripsi_hotel,
                "Kota" => $id_kota,
                "Daerah" => $id_daerah,
                "gambar_hotel" => $filename
            ]);
            return redirect('/userhotel/profil')->with('alert',"Perubahan berhasil disimpan");
        }
        catch (Exception $e) {
            return back()->with('alert',$e->getMessage());
        }

    }
    //--PROFIL
}
