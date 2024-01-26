@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            @if (count(Session::get('cart', []))==0)

            <div class="col-6 offset-1">
                <div class="alert alert-info">
                    <p>Vasa korpa je trenutno prazna</p>
                </div>
             </div>

             @else
             <form action="{{route('checkoutView')}}" method="POST">
                @csrf
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Size</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    @foreach ($cart as $product)
    <tr>
        <input type="hidden" name="productId" value="{{$product['id']}}">
                <input type="hidden" name="size" value="{{$product['size']}}">
        <td>
            <img src="img/{{$product['image']}}" alt="" style="width: 50px;"> {{$product['name']}}
        </td>
        <!-- Dodajte jedinstveni identifikator kao deo ID-a elementa -->
        <td class="align-middle" id="price_{{$product['id']}}_{{$product['size']}}">{{$product['price']}}</td>
        <td class="align-middle">
            <div class="input-group quantity mx-auto" style="width: 100px;">
                <div class="input-group-btn">
                    <p class="minus" data-product-id="{{$product['id']}}" data-size="{{$product['size']}}">
                        <i class="fa fa-minus"></i>
                    </p>
                </div>
                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="quantity_{{$product['id']}}_{{$product['size']}}" id="quantity_{{$product['id']}}_{{$product['size']}}" value="{{$product['quantity']}}">
                <div class="input-group-btn">
                    <p class="plus" data-product-id="{{$product['id']}}" data-size="{{$product['size']}}">
                        <i class="fa fa-plus"></i>
                    </p>
                </div>
            </div>
        </td>
        <td class="align-middle totalTable" id="totalTable_{{$product['id']}}_{{$product['size']}}">{{$product['price']}}</td>
        <td class="align-middle">{{$product['size']}}</td>
    </tr>
@endforeach

                </tbody>
            </table>
            @if (count(Session::get('cart', [])) >0)
                <a class="btn btn-info" href="{{route('cartEmpty')}}">Isprazni korpu</a>
            @endif

            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" type="submit">Proceed To Checkout</button>

             </form>
            @endif
        </div>

        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3 form-control"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 class="subtotal">0.00</h6>
                    </div>
                    <input type="hidden" name="subtotal" class="subtotal" value="0.00">



                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">8 KM</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="totalCart" id="totalCart">0.00</h5>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
      updateTotalTable();
      $(document).on('click', '.minus', function(){
              var productId = $(this).data('product-id');
              var size = $(this).data('size');
              updateQuantity(productId, size, -1);
          });

          $(document).on('click', '.plus', function(){
              var productId = $(this).data('product-id');
              var size = $(this).data('size');
              updateQuantity(productId, size, 1);
          });


          function updateQuantity(productId, size, change) {
    var inputQuantity = $('#quantity_' + productId + '_' + size);
    var currentQuantity = parseInt(inputQuantity.val(), 10);

    if (currentQuantity + change >= 1) {
        inputQuantity.val(currentQuantity + change);

        $.ajax({
            type: 'POST',
            url: '/update-cart',
            data: {
                _token: csrfToken,
                productId: productId,
                size: size,
                quantity: currentQuantity + change
            },
            success: function(response) {
                console.log('Količina je uspešno ažurirana na serveru.');
                updateCartSummary();
                updateTotalTable(productId, size);
            },
            error: function(error) {
                console.error('Došlo je do greške prilikom ažuriranja količine na serveru.');
            }
        });
        updateTotalTable(productId, size);
                  updateCartSummary();
    }
}


          function updateTotalTable(productId, size){
              var inputQuantity = $('#quantity_' + productId + '_' + size).val();


              var productPrice = parseFloat($('#price_' + productId + '_' + size).text());

              var totalTable = $('#totalTable_' + productId + '_' + size);

              var totalValue = productPrice*inputQuantity;
              totalTable.text(totalValue.toFixed(2));
              updateCartSummary();
          }

          function updateCartSummary() {
              var totalCart = 0;

              // Iterirajte kroz svaki redak u tabeli i dodajte vrednosti
              $('.totalTable').each(function() {
                  totalCart += parseFloat($(this).text());
              });

              var shipping = 8;
              var cijena = totalCart+shipping;
               $('.subtotal').text(totalCart.toFixed(2));
               $('.subtotal').val(totalCart.toFixed(2));


              // Ažurirajte vrednost ukupne korpe
              if($('.subtotal').text() == 0.00){
                  $('#totalCart').text('0.00');
              }else{
                  $('#totalCart').text(cijena.toFixed(2));


              }



          }
    })



  </script>

@endsection

@include('partials.footer-view-all')
