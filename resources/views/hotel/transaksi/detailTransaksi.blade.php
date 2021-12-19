@extends('hotel.mainpage')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col">
                        <h1>DETAIL TRANSAKSI</h1>
                    </div>
                    <div class="col" style="margin-top: 10px">
                        <button class="btn btn-secondary" style="float: right;" type="submit">Edit Profil</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row justify-content-start">
                                    <div class="col-2">ID Transaksi</div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="idHtrans" value="{{$htrans->id_htrans}}" readonly="true">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-start">
                                    <div class="col-2">Tanggal Transaksi</div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="tglHTrans" value="{{$htrans->tgl_transaksi}}" readonly="true">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-start">
                                    <div class="col-2">Total Transaksi</div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="totalHarga" value="{{$htrans->total_harga}}" readonly="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
        <!-- /.content -->
@endsection
