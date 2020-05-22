<div class="clearfix row">

    <style >
        .display-block {
            display: block !important;
        }
    </style>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-purple">
                <h2>
                    VPN ACCOUNT DETAILS
                </h2>
            </div>
            <div class="body table-responsive">
                <div class="row-clearfix">
                    <div class="col-lg-12">

                        <div class="col-lg-12">

                            @if( $softetherAccount->auth_type == 'CERTIFICATE' )
                                <div class="alert bg-blue">
                                    L2TP over IPSec using Passwordless&#8482; is not supported for now, Disable Passwordless&#8482; if you want to use L2TP over IPSec!
                                </div>

                                <hr>
                            @endif


                        </div>

                        <div class="col-lg-6">

                            <h4>CREDENTIALS</h4>
                            <hr>

                            <div class="clearfix row">


                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>Server Address</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $serverAddress ?? 'UNKNOWN' }}</b>
                                    </div>

                                </div>

                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>Username</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $username }}</b>
                                    </div>

                                </div>

                                <div class="text-left col-lg-6">
                                    <div>
                                        <b>Password</b>
                                    </div>
                                </div>


                                <div class="text-right col-lg-6">
                                    <div>
                                        @if( $showPassword )
                                            <p><b>{{ $password }}</b></p>
                                        @else
                                            <p><b>{{ str_repeat('*', strlen($password)) }}</b> <a wire:click="$set('showPassword', true)" style="cursor: pointer;">show</a></p>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-left col-lg-8">
                                    <div>
                                        <b>IPSec Pre-Shared Key (PSK)</b>
                                    </div>
                                </div>


                                <div class="text-right col-lg-4">
                                    <div>
                                        <b>{{ $psk }}</b>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6">
                            <h4>SETTINGS</h4>
                            <hr>

                            <div class="clearfix row waitMe_container" data-waitme_id="169">



                                <div class="col-lg-6">
                                    <div >
                                        Passwordless&#8482;
                                    </div>
                                </div>

                                <div class="text-right col-lg-6">
                                    <div>
                                        <div class="switch">
                                            <label><input wire:model="passwordLess"  type="checkbox" checked=""><span class="lever switch-col-deep-purple"></span></label>
                                        </div>
                                    </div>
                                </div>

                                <div wire:target="passwordLess" wire:loading wire:loading.class="display-block"  data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);backdrop-filter: blur(.7px);text-align:center;">
                                    <div class="waitMe_content" style="margin-top: 0px;">
                                        <div class="waitMe_progress rotation" style="">
                                            <div class="waitMe_progress_elem1" style="border-color:#663AB7"></div>
                                        </div>
                                        </br>
                                        <div class="waitMe_text" style="color:#663AB7">Saving...</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



</div>


@push('scripts')
<script charset="utf-8">

    window.livewire.on('UpdatingSoftetherAccountDetails', function(e) {
            {{--alert('updating');--}}
    })
</script>
@endpush
