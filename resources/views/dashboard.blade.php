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

<div class="clearfix row">

    <div class="col-lg-12">

        <hr>

    </div>

</div>

<!-- WIDGETS -->

<div class="clearfix row">
    <div class="col-lg-12">
        {{ Widget::group('half-size')->display() }}
    </div>
</div>

<div class="clearfix row">
    {{ Widget::group('full-size')->display() }}
</div>

@endsection
