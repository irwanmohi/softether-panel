@extends('layouts.master')
@section('title', 'Reseller Setting')
@section('page_title', 'Reseller Setting')

@section('content')
<div class="clearfix row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    RESELLER CONFIGURATION
                    <small>Below is settings to configure the Reseller behaviour</small>
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SETTING</th>
                            <th>VALUE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $setting->display_name }}</td>
                                <td>

                                    @if( $setting->kind == 'boolean' )
                                        {!! boolean_to_label($setting->value) !!}
                                    @else
                                        {{ $setting->value }}
                                    @endif

                                </td>
                                <td>
                                    <button type="button" onclick="$.AdminBSB.panel.settingModal({{ $setting->id }})" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Setting" data-original-title="Edit Setting">
                                        <i class="material-icons">mode_edit</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function() {
        //Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //Popover
        $('[data-toggle="popover"]').popover();
    });

</script>

@endsection

