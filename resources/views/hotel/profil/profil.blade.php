@extends('hotel.mainpage')
@section('content')
    <h1>PROFIL</h1>
    <form action="/hotel/profil/edit" method="get">
        <button type="submit">Edit Profil</button>
    </form>
@endsection
