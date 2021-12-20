@extends('hotel.mainpage')
@section('content')
    <h1>LIST TRANSAKSI</h1>
    <table border="1px" class="table table-sm table-bordered">
        <thead class="table-light">
            <th>ID</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Detail</th>
        </thead>
        @foreach ($htrans as $item)
            <tr>
                <td>{{$item->id_htrans}}</td>
                <td>{{$item->tgl_transaksi}}</td>
                <td>{{$item->total_harga}}</td>
                <td><form action="/userhotel/transaksi/detail" method="post">
                    @csrf
                    <button type="submit" value="{{$item->id_htrans}}" name="id_htrans" class="btn btn-secondary">Detail</button>
                </form></td>
            </tr>
        @endforeach
    </table>
@endsection
