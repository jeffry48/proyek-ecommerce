@extends('hotel.mainpage')
@section('content')
    <h1>PROFIL</h1>
    <form action="/userhotel/profil/edit" method="get">
        <button type="submit">Edit Profil</button><br>
        @include('hotel.profil.isiprofil')
    </form>
@endsection
