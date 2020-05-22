@extends('layouts.master-plain')
@section('title', 'VPN ACCOUNT')
@section('content')

    <div style="margin: 50px;">
        @livewire('softether-account-details-public', ['softetherAccount' => $account])
    </div>

@endsection
