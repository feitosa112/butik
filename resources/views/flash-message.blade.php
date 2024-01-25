@if ($message = Session::get('success'))
<div class="col-4 offset-8">
    <div class="alert alert-success" role="alert">
        {{$message}}
      </div>
</div>

@endif

@if ($message = Session::get('deleteFromCart'))
<div class="col-4 offset-8">
    <div class="alert alert-success" role="alert">
        {{$message}}
      </div>
</div>

@endif

@if ($message = Session::get('errorDeleteFromCart'))
<div class="col-4 offset-8">
    <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
</div>

@endif
