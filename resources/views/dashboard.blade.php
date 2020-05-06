@extends('layouts.master')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('content')

{{--Load plugin--}}

@if(user()->isAdmin())
    @foreach(Alert::getAlerts() as $alert)
        {!! $alert->render() !!}
    @endforeach
@endif

{{--Info Box Widgets--}}


@endsection
