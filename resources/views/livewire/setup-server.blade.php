@section('title', 'Installing Software')
@section('page_title', sprintf("INSTALLING %s", Str::upper($softwareName)))

@php

$software = ServerUtils::getSoftware($softwareId);

@endphp

<div class="clearfix row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" wire:poll>

        @switch($server->current_state)
            @case('TO_RUN_SOFTWARE_SCRIPT')
                @livewire('run-software-script', ['server' => $server, 'softwareId' => $softwareId])
                @break

            @case('INSTALLING_SOFTWARE')
                @livewire('installing-software-progress', ['server' => $server, 'softwareId' => $softwareId])
                @break
            @default

        @endswitch

    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-purple">
                <h2 class="text-center">
                    ABOUT {{ Str::upper($software->getName()) }}
                </h2>
            </div>
            <div class="body">

                <img src="{{ $software->getImagePath() }}" class="img-responsive" style="max-height: 100px;" alt="">

                <hr>

                {!! $software->getDescription() !!}

                @if( ! empty( $software->getReservedPorts() ) )

                    <hr>

                    <p>Port wil be used :</p>

                    @foreach($software->getReservedPorts() as $port)
                        <span class="badge bg-deep-purple badge-lg">{{ $server->ip }}:{{ $port }}</span>
                    @endforeach

                    <hr>

                    <p><span class="col-red font-12">*</span> Make sure ports above is allowed by firewall & not already used.</p>
                @endif

            </div>
        </div>
    </div>

</div>
