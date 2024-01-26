@section('o_nama')
<h3 class="footer-text">{{$boutique->butik_name}}</h3>

@endsection

@section('footer_adresa')
{{$boutique->address}}

@endsection
@section('footer_email')
@if ($boutique->email != null)
{{$boutique->email}}

@endif

@endsection

@section('footer_tel')
@if ($boutique->phone != null)
{{$boutique->phone}}

@endif

@endsection

@section('footer_lista')
@foreach ($products as $key => $product)
    @if ($key < 6)
        <a href="">{{$product->product_name}}</a>
    @else
        @break
    @endif
@endforeach

@endsection
