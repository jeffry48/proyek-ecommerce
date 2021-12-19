@extends('hotel.mainpage')
@section('content')
    <div class="content-wrapper">
        <form action="/userhotel/product/{{$kamar->id_kategori}}/edit" method="get">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col">
                        <h1>DETAIL KAMAR</h1>
                    </div>
                    <div class="col" style="margin-top: 10px">
                        <button class="btn btn-secondary" style="float: right;" type="submit" name="btnEdit">Edit Detail</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                @include('hotel.product.isiDetailProduct')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        </form>
        <!-- /.content -->
@endsection
