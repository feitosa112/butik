@section('o_nama')
<h3 class="footer-text">O platformi</h3>
@endsection
@section('o_nama_text')
Platforma napravljena u cilju predstavljanja veceg broja butika na jednom mjestu.Mali online trzni centar,gdje kupci mogu pregledati na jednom mjestu sadrzaj razlicitih butika i iz svih njih narucivati robu a platiti samo jednu dostavu.

@endsection
@section('footer_email')
butiktrend@gmail.com

@endsection

@section('footer_lista')
@foreach ($allBoutiques as $boutique)
<a href="" style="text-decoration: none">{{$boutique->butik_name}}</a>

@endforeach

@endsection
