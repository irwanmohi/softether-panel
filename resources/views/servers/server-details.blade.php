@extends('layouts.master')
@section('title', sprintf("Server %s", $server->name))
@section('page_title', 'SERVER DETAILS')

@section('content')
    @livewire('server-details', ['server' => $server])
@endsection
