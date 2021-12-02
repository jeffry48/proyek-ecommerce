@extends('hotel.mainpage')
@section('content')

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

<h2>Pesanan yang Sedang Berlangsung</h2>
@isset($pesanan)
    {{-- tampilkan tabel --}}
@else
Tidak ada pesanan yang sedang berlangsung
@endisset
@endsection
