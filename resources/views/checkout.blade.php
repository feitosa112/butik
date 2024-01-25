@extends('layouts.app')

@section('content')
@dd($cart)
<!-- Checkout Start -->
<div class="container-fluid">
    <form action="" method="POST">
    <div class="row px-xl-5">
        <div class="col-lg-7">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" placeholder="{{Auth::user() ? Auth::user()->name : 'Name'}}" value="{{Auth::user() ? Auth::user()->name : ''}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" placeholder="{{Auth::user() ? Auth::user()->surname : 'Surname'}}" value="{{Auth::user() ? Auth::user()->surname : ''}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" placeholder="{{Auth::user() ? Auth::user()->email : 'Email'}}" value="{{Auth::user() ? Auth::user()->email : ''}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="text" placeholder="Phone">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" placeholder="Address">
                    </div>


                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="City">
                    </div>

                </div>
            </div>

        </div>
        <div class="col-lg-5">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    @foreach ($cart as $item)


                    @endforeach







                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 class="subtotal">0.00</h6>

                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">{{$shipping}} KM</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="totalCart" id="totalCart">0.00</h5>

                    </div>
                </div>
            </div>
            <div class="mb-5">
                <div class="bg-light p-30">



                    <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<!-- Checkout End -->

@endsection

@section('scripts')

<script>
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
