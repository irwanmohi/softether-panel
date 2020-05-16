<div wire:init="loadCard">

    @livewire('preloader-classes')

    @if( ! $readyToLoad )

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-{{ random_color_class() }}">
                    <h2 class="text-center">
                        {{-- DROPBEAR - <span id="dropbear_status">ONLINE</span> --}}
                        <div class="preloader-default"></div>
                    </h2>
                </div>
                <div class="body">
                    <h1 class="text-center">
                        {{-- <span id="dropbear_status">ONLINE</span> --}}
                        <div class="preloader-default-40"></div>
                        <div class="preloader-default-90"></div>
                        <div class="preloader-default-60"></div>
                    </h1>
                    <hr />
                    <div class="preloader-red-button"></div>
                    <div class="preloader-yellow-button"></div>
                </div>
            </div>
        </div>

    @else

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header" style="display: flex">


                    <div style="flex: 50%">
                        <h2 class="float-left">
                            {{ \Str::upper($this->server->name) }} <small>{{ $this->server->ip }}</small>
                        </h2>
                    </div>

                    <div style="flex: 50%">

                        <div class="text-right">

                            @if( $this->server->current_state == 'SETUP_COMPLETED' && $this->server->setup_completed )
                                @if( $this->server->online_status == 'ONLINE' )
                                    <span class="badge bg-green badge-lg">ONLINE</span>
                                @else
                                    <span class="badge bg-red badge-lg">OFFLINE</span>
                                @endif
                            @else
                                <span class="badge bg-grey badge-lg">UNKNOWN</span>
                            @endif
                        </div>

                    </div>


                </div>
                <div class="body">

                    @if( empty($this->services) )

                        <p class="text-center">UNABLE TO FETCH SERVER RESOURCE DETAILS</p>

                    @else

                        @foreach($this->services as $service)


                            <div style="display: flex">
                                <div style="flex: 50%" class="text-left">
                                    <p class="text-grey">{{ $service['name'] }} </p>
                                </div>

                                <div style="flex: 50%" class="text-right">
                                    <p class="text-grey">{{ $service['used'] }}/{{ $service['total'] }} </p>
                                </div>
                            </div>
                            <div class="progress" style="height: 10px">
                                <div class="progress-bar bg-deep-purple progress-bar-striped active" role="progressbar" aria-valuenow="{{ $service['percentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $service['percentage'] }}%">
                                </div>
                            </div>

                        @endforeach

                    @endif




                    <hr>
                    <div class="text-right">
                        <a class="btn bg-deep-purple" href="{{ route('servers.show', [encrypt($this->server->id)]) }}"><span>VIEW</span> <i class="material-icons">arrow_forward</i></a>
                    </div>

                </div>
            </div>
        </div>

    @endif

</div>
