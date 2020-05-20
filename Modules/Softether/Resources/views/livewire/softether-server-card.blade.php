<div class="@if(empty($style)) col-lg-4 col-md-4 @else {{ $style }} @endif col-sm-12 col-xs-12">
    <div class="card">
        <div class="header" style="display: flex;border-bottom: transparent;">


            <div style="flex: 50%">
                <h2 class="float-left">
                    {{ \Str::upper($server->name) }} <small>{{ $server->ip }}</small>
                </h2>
            </div>

            <div style="flex: 50%">

                <div class="text-right">

                    @if( $this->server->current_state == 'SETUP_COMPLETED' && $server->setup_completed )
                        @if( $server->online_status == 'ONLINE' )
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

            <div style="display: flex">

                <div style="flex: 50%">
                    <div class="float-left col-grey">
                        <small>Price:</small>
                        <h4 style="margin-top: 2px;">{{ $softetherServer->account_price }}/<small>MONTH</small></h4>
                    </div>
                </div>

                @if( $withButton )

                    <div style="flex: 50%">

                        <div class="text-right">
                            <a
                                @if(  ! user()->isAdmin() && user()->balance < $softetherServer->account_price )
                                    disabled

                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Not enough balance, please top-up"
                                @endif
                                class="btn bg-deep-purple btn-lg"
                                href="{{ route('softether.accounts.create_account', [encrypt($softetherServer->id)]) }}">
                            <span>CREATE ACCOUNT</span> <i class="material-icons">arrow_forward</i></a>
                        </div>

                    </div>

                @endif


            </div>


        </div>
    </div>
</div>
