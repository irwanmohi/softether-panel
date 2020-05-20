@extends('layouts.master')
@section('title', 'VPN Account')
@section('page_title', 'VPN ACCOUNT DETAILS')
@section('content')

    @livewire('show-softether-account-details', ['softetherAccount' => $account])

@endsection
