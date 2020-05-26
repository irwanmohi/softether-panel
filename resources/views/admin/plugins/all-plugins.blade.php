@extends('layouts.master')
@section('title', 'Manage Plugin')
@section('page_title', 'MANAGE INSTALLED PLUGINS')

@section('content')

    @if( $plugins->isEmpty() )

        <div class="text-center" style="margin-top: 100px;">
            <h1>NO PLUGINS INSTALLED</h1>
            <button class="text-center btn btn-lg bg-deep-purple">
                <span>ADD PLUGIN NOW</span>
                &nbsp;
                <i class="material-icons">extension</i>
            </button>
        </div>

    @else

        <div class="clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            PLUGINS
                            <small>Plugins Works by extending the basic functionality of the panel, below is the installed plugin.</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a href="/admin/plugins/create" class=" btn bg-deep-purple" data-turbolinks="false">
                                ADD NEW PLUGIN
                            </a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>PLUGIN NAME</th>
                                    <th>DESCRIPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plugins as $plugin)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $plugin->getTitle() }}</td>
                                        <td>{{ $plugin->getDescription() }}</td>
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
