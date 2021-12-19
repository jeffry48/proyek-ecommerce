@extends('hotel.mainpage')
@section('content')
    <h1>DETAIL KAMAR</h1>
    <form action="/userhotel/product/{{$kamar->id_kategori}}/edit" method="get">
        <button type="submit" name="btnEdit">Edit Detail</button>
    </form>
    @include('hotel.product.isiDetailProduct')
@endsection
