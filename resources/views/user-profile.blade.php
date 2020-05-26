@extends('layouts.master')
@section('title', 'Profile')
@section('page_title', 'PROFILE')
@section('content')

    @livewire('user-profile', ['user' => user()->getValue()])

@endsection
