@extends('layouts.app')
@section('content')
@section('naziv_jedan')
{{$boutique->butik_name}}

@endsection

@section('naziv_dva')
{{$boutique->address}}

@endsection
<div class="container text-center">
    <div class="jumbotron">
        <h1>{{$boutique->butik_name}}</h1>
        @if ($boutique->description != null)
        {{$boutique->description}}
          @else
          <p style="color:#3D3B40">Nalazimo se u TC EMPORIUM u prvom redu od ulaza,sa lijeve strane.Nudimo sirok asortiman robe iz muske i zenske kolekcije.</p>
        @endif
    </div>
</div>
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-6 col-sm-6 col-lg-4 mb-2">
                <?php $product_name= str_replace(' ','-',$product->product_name) ?>
                <a href="{{route('thisProduct',['product_name'=>$product_name,'id'=>$product->id])}}" style="text-decoration: none">
                    <div class="card" id="card" style="max-width: 300px">

                        <div class="card-header">
                            <img src="/img/{{$product->img1}}" style="max-height: 200px" id="this_boutique_image" class="img-fluid card-img-top" alt="">
                        </div>

                        <div class="card-body" style="padding: 0">
                            <h3 class="card-title naslov">{{$product->product_name}}</h3>
                            <h4 class="card-subtitle mb-2 float-left naslov" style="color: #65B741">{{$product->price}} KM</h4>
                            @if ($product->old_price !=null)
                            <small class="card-subtitle mb-2 float-right podnaslov" style="color: #B80000"><del>{{$product->old_price}} KM</del></small>
                            @endif
                        </div>
                        <div class="card-footer" style="padding: 2px">
                            <a href="{{route('thisProduct',['product_name'=>$product_name,'id'=>$product->id])}}" style="border-radius: 5px" class="btn btn-primary btn-sm float-left mobile-button">Kupi</a>

                            <span class="float-right">
                                <a href="#" class="ml-2 podnaslov" style="color:#40A2D8;text-decoration:none ">Sviđa mi se</a>
                            </span>

                        </div>





                    </div>
                </a>
            </div>

        @endforeach
    </div>
</div>
@endsection

@include('partials.footer-view-thisBoutique')
