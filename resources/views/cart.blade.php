@extends('layouts.app')
@section('content')
@foreach ($cart as $product)
@php
    var_dump($product);
@endphp

@endforeach

@endsection
