@extends('layouts.app')
@section('content')
<div class="container text-center">
    <h1>{{$boutique->butik_name}}</h1>
</div>
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-6 col-sm-6 col-lg-4 mb-2">
                <a href="">
                    <div class="card" style="max-width: 250px">

                        <div class="card-header">
                            <img src="/img/{{$product->img1}}" style="max-height: 200px" class="img-fluid" alt="">
                        </div>

                        <div class="card-body">
                            <p class="float-left"><small>{{$product->product_name}}</small></p>
                            <a href="" class="badge bg-success badge-sm float-end">{{$product->price}} KM</a>
                        </div>

                        <div class="card-footer">
                            <a href="" class="badge bg-info badge-sm float-start">Dodaj u korpu</a>
                        </div>
                    </div>
                </a>
            </div>

        @endforeach
    </div>
</div>

@endsection
