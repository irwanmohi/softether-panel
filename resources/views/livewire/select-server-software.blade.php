@section('title', 'Select VPN Software')
@section('page_title', 'Select VPN Software')

<div class="clearfix row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <h2 class="card-inside-title">Please Select VPN Software you want to use</h2>
                <hr />


                <div class="clearfix row">

                    @foreach (ServerUtils::getAllSoftware() as $id => $software)

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header bg-deep-purple">
                                    <h2 class="text-center">
                                        {{ Str::upper($software->getName()) }}
                                    </h2>
                                </div>
                                <div class="body">

                                    <img src="{{ $software->getImagePath() }}" class="img-responsive" style="max-height: 100px;" alt="">

                                    <hr>

                                    {!! $software->getDescription() !!}

                                    <hr />

                                    <div class="text-right">
                                        <a class="btn bg-deep-purple" href="{{ route('servers.server_setup.setup-server', [$encryptedServerId, encrypt($id)]) }}"><span>INSTALL</span> &nbsp; <i class="material-icons">arrow_forward</i></a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>
    </div>
</div>
