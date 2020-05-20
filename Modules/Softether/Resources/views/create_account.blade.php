@extends('layouts.master')
@section('title', 'Create Account')
@section('page_title', 'CREATE ACCOUNT')

@section('content')
    @livewire('create-softether-account', ['softetherServer' => $softetherServer])
@endsection
