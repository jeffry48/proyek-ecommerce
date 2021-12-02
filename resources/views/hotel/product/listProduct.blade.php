@extends('hotel.mainpage')
@section('content')
<h1>LIST PRODUCT</h1>
<form action="/product" method="get">
    Filter :
    <select name="filter">
        <option value="all">Semua kamar</option>
        <option value="promo">Kamar yang promo</option>
        <option value="available">Kamar yang tersedia</option>
        <option value="unavailable">Kamar yang tidak tersedia</option>
    </ul>
</form>

@isset($products)
<table>
    <tr>
        <th>Tipe Kamar</th>
        <th>Tipe Ranjang</th>
        <th>Kapasitas Orang</th>
        <th>Harga</th>
        <th>Fasilitas Tambahan</th>
        <th>Jumlah kamar</th>
        <th>Detail kamar</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{$product->nama}} </td>
            <td>{{$product->ranjang}}</td>
        @if (count($product->jenisProduct)>0){
            @foreach ($product->jenisProduct as $item)
                <tr>
                    <td>{{$item->jmlhOrang}}</td>
                    <td>{{$item->harga}}</td>
                    <td>
                        <ul>
                        @foreach ($item->tambahan as $tambahan)
                                <li><b>{{$tambahan->nama}}</b><br>{{$tambahan->deskripsi}}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>{{$item->jmlhProduct}}</td>
                    <td>
                        <form action="/product/{{$product->id}}" method="get">
                            <button type="submit">Lihat Detail</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        }
        @endif
        </tr>
    @endforeach
</table>
@endisset
@endsection
