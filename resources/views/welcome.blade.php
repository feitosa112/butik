@extends('layouts.app')
@section('title')
ButikTrend

@endsection
@section('content')
@section('naziv_jedan')
Butik

@endsection

@section('naziv_dva')
Trend

@endsection
@include('templates.allBoutique')
@include('templates.allCategories')

@endsection

@include('partials.footer-view-all')
