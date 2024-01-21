<div class="container-fluid text-center mb-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="row ms-5 me-2">
                @foreach ($allBoutiques as $boutique)
                    <div class="col-6 col-md-6 col-sm-6 col-lg-4 mb-2">

                        <?php $boutique_name = str_replace(' ','-',$boutique->butik_name) ?>
                            <form action="{{route('thisBoutique',['butik_name'=>$boutique_name])}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$boutique->id}}">

                                <div class="card" id="card" style="border-radius: 5%;box-shadow:0px 0px 5px rgba(0,0,0,0.5);">

                                    <div class="card-header">
                                        @if ($boutique->image != null)
                                            <img src="/img/{{$boutique->image}}" class="img-fluid" alt="">
                                        @endif
                                    </div>

                                    <div class="card-body naslov mt-2" style="padding: 0">
                                        <h4 style="font-weight: 500">{{$boutique->butik_name}}</h4>
                                    </div>

                                    <div class="card-footer podnaslov">
                                        <p class="float-left">
                                            <small>{{$boutique->address}}</small>
                                        </p>

                                        <p class="float-right podnaslov">
                                            @if ($boutique->phone != null)
                                                <small>{{$boutique->phone}}</small>
                                            @endif
                                        </p>
                                        <button class="btn btn-primary form-control" style="border-radius: 5px" id="butik-submit" type="submit">Pogledaj</button>
                                    </div>
                                </div>
                            </form>

                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
{{-- @dd($allBoutiques) --}}
