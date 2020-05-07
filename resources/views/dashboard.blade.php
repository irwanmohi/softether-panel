@extends('layouts.master')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('content')

{{--Load plugin--}}

<div class="clearfix row">
    @if(user()->isAdmin())
        @foreach(Alert::getAlerts() as $alert)
            {!! $alert->render() !!}
        @endforeach
    @endif
</div>

{{--Info Box Widgets--}}

<div class="clearfix row">
    @foreach(Infobox::getBoxes() as $box)

        {!! $box->getView() !!}

    @endforeach
</div>


@endsection
