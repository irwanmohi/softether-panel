@extends('layouts.master')
@section('title', 'VPN Accounts')
@section('page_title', 'VPN ACCOUNTS')
@section('content')
    @livewire('softether-account-list', ['user' => user()->getValue()])
@endsection
