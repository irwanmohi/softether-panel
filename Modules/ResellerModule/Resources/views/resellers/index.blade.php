@extends('layouts.master')
@section('title', 'Resellers')
@section('page_title', 'Manage Resellers')
@section('content')

    @if( $resellers->isEmpty() )

        <div class="text-center" style="margin-top: 100px;">
            <h1>NO RESELLERS CREATED</h1>
            <a href="{{ route('reseller-plugin.resellers.create') }}" class="text-center btn btn-lg bg-deep-purple">
                <span>CREATE RESELER NOW</span>
                &nbsp;
                <i class="material-icons">assignment_ind</i>
            </a>
        </div>

    @else

        <div class="clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            RESELLERS
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>RESELLER NAME</th>
                                    <th>RESELLER EMAIL</th>
                                    <th>RESELLER BALANCE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resellers as $reseller)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $reseller->name }}</td>
                                        <td>{{ $reseller->email }}</td>
                                        <td><label class="label bg-deep-purple">{{ $reseller->balance }}</label></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endif


@endsection

