@extends('hotel.mainpage')
@section('content')
<h1>LIST PRODUCT</h1>
<form action="/userhotel/product" method="get">
    Filter :
    <select name="filter">
        <option value="all">Semua kamar</option>
        <option value="promo">Kamar yang promo</option>
        <option value="available">Kamar yang tersedia</option>
        <option value="unavailable">Kamar yang tidak tersedia</option>
    </select>
</form>
<br>
<form action="/userhotel/product/tambah" method="get">
    <button type="submit" name="btnTambah">Tambah Kamar</button>
</form>
<br><br>
@isset($products)
<table border="1px solid black">
    <tr>
        <th>Nama Kamar</th>
        <th>Harga</th>
        <th>Jumlah kamar</th>
        <th>Detail</th>
        <th>Hapus</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{$product->nama_kamar}} </td>
            <td>{{$product->harga_kamar}}</td>
            <td>{{$product->jumlah_kamar}}</td>
            <td>
                <form action="/userhotel/product/{{$product->id_kategori}}" method="get">
                    <button name="btnDetail">Detail</button>
                </form>
            </td>
            <td>
                <form action="/userhotel/product/hapus" id="formHapus" method="post">
                    @csrf
                    <button name="btnHapus" id="btnHapusProduct" value="{{$product->id_kategori}}">Hapus</button>
                </form>
                <script>
                    $(document).on('click', '#btnHapusProduct', function (event) {
                        if (!confirm("Apakah yakin untuk menghapus tipe kamar ini?")) {
                            event.preventDefault();
                        }
                        e.stopImmediatePropagation();
                    });
                </script>
            </td>
        </tr>
    @endforeach
</table>
@endisset
@endsection
