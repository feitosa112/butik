@extends('layouts.app')
@section('content')
@section('naziv_jedan')
{{$product->boutique->butik_name}}


@endsection



@section('content')
<h1 class="text-center">
    {{$product->boutique->butik_name}}
</h1>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-12 offset-1">
            <img src="/img/{{$product->img1}}" class="product-img" id="current" style="margin: 0 auto" alt=""><br>
            @if ($product->img2 != null)
            <img src="/img/{{$product->img2}}" class="second mt-2 ml-2" style="margin: 0 auto;height:50px;width:50px" alt="">
            @endif
            @if ($product->img3 != null)
            <img src="/img/{{$product->img3}}" class="second mt-2 ml-2" style="margin: 0 auto;height:50px;width:50px" alt="">
            @endif
            <img src="/img/{{$product->img1}}" class="second mt-2 ml-2" style="margin: 0 auto;height:50px;width:50px"alt=""><br>

       </div>

       <div class="col-lg-4">
           <h2>{{$product->product_name}}</h2>
           @if ($product->description != null)
           <p>{{$product->description}}</p>
           @endif
           <button class="btn btn-success">{{$product->price}} KM</button><br>
           @if ($product->old_price !=null)
           <p style="color: red"><del>{{$product->old_price}} KM</del></p>

           @endif
           <br>

           <form action="{{route('addToCart',['id'=>$product->id])}}" method="POST">
            @csrf
            <p>Velicina:</p>
            <div style="display: flex;gap:10px;padding-bottom:15px">
                <input type="radio" name="size" value="s">S<br>
                <input type="radio" name="size" value="l">L<br>
                <input type="radio" name="size" value="xl">XL<br>
                <input type="radio" name="size" value="xxl">XXL<br>
            </div>

            @error('size')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <p>Kolicina:</p>
            <div class="input-group quantity mb-5" style="width: 100px;">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-minus rounded-circle bg-light border minusBtn">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <input class="quantityInput form-control form-control-sm text-center border-0" name="quantity" type="text" value="1">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-plus rounded-circle bg-light border plusBtn">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

            <button class="btn btn-warning float-left" type="submit">Dodaj u korpu</button>

           </form>

       </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    var current=document.getElementById('current');
    var slike=document.getElementsByClassName('second');

    for(var i=0;i<slike.length;i++){
    slike[i].addEventListener('click',display);
    }
    function display(){
    var sl=this.getAttribute('src');
    current.setAttribute('src',sl);
    }



    var minusButtons = document.querySelectorAll('.minusBtn');
    var plusButtons = document.querySelectorAll('.plusBtn');
    var quantityInputs = document.querySelectorAll('.quantityInput');

    for (var i = 0; i < minusButtons.length; i++) {
    minusButtons[i].addEventListener('click', function() {
    event.preventDefault();
        decrementQuantity(this);
    });
}

for (var i = 0; i < plusButtons.length; i++) {
    plusButtons[i].addEventListener('click', function() {
        event.preventDefault();
        incrementQuantity(this);
    });
}

function incrementQuantity(button) {
    var quantityInput = button.closest('.quantity').querySelector('.quantityInput');
    var currentValue = parseInt(quantityInput.value);

    // Povećaj vrednost samo ako je trenutna vrednost manja od nekog maksimuma
    if (currentValue < 10) {
        quantityInput.value = currentValue + 1;
        updateTotalColumn(quantityInput);
        updateSubtotal();
    }
}

function decrementQuantity(button) {
    var quantityInput = button.closest('.quantity').querySelector('.quantityInput');
    var currentValue = parseInt(quantityInput.value);

    // Smanji vrednost samo ako je trenutna vrednost veća od nekog minimuma
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        updateTotalColumn(quantityInput);
        updateSubtotal();
    }
}


</script>
@endsection

