@extends('hotel.mainpage')
@section('content')

<h1>Hotel
    @isset($nama_hotel) {{$nama_hotel}}
    @else Unknown
@endisset</h1>
<h2>Welcome,
    @isset($adminhotel->nama_pemilik) {{$adminhotel->nama_pemilik}}
    @else adminhotel1
@endisset</h1>
<br>
<h2>Kedatangan untuk Hari Ini</h2>
@isset($arrival)
    {{-- tampilkan tabel --}}
@else
Tidak ada kedatangan untuk pesanan hari ini.
@endisset

<h2>Pesanan yang Belum Dikonfirmasi</h2>
@isset($pesananUnconf)
    {{-- tampilkan tabel --}}
@else
Tidak ada pesanan yang belum dikonfirmasi
@endisset

<h2>Pesanan yang Belum Dibayar</h2>
@isset($pesanan)
    {{-- tampilkan tabel --}}
@else
Tidak ada pesanan yang belum dibayar
@endisset
@endsection
