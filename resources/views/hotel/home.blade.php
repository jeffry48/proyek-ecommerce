@extends('hotel.mainpage')
@section('content')
<center><h1>HOME</h1></center>
<center><h3>Welcome,
    {{$adminhotel->nama_pemilik}}
</h3></center>
<center><h4>{{$hotel->nama_hotel}}</h4></center>
<br>

@endsection
