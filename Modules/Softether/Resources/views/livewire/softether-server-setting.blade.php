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
                    SOFTETHER SERVER SETTING
                </h2>
            </div>
            <div class="body table-responsive">
                <div class="row-clearfix">
                    <div class="col-lg-12">

                        <div class="col-lg-6">

                            <h4>SERVER DETAILS</h4>
                            <hr>

                            <div class="clearfix row waitMe_container" data-waitme_id="170">


                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>Server Name</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $serverName }}</b>
                                    </div>

                                </div>


                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>Server Address</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $serverAddress  }}</b>
                                    </div>

                                </div>

                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>HUB Name</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $hubName  }}</b>
                                    </div>

                                </div>


                                <div class="text-left col-lg-6">
                                    <div>
                                        <b>HUB Password</b>
                                    </div>
                                </div>


                                <div class="text-right col-lg-6">
                                    <div>
                                        @if( $showHubPassword )
                                            <p><b>{{ $hubPassword }}</b></p>
                                        @else
                                            <p><b>{{ str_repeat('*', strlen($hubPassword)) }}</b> <a wire:click="$set('showHubPassword', true)" style="cursor: pointer;">show</a></p>
                                        @endif
                                    </div>
                                </div>


                                <div class="text-left col-lg-6">
                                    <div>
                                        <b>Admin Password</b>
                                    </div>
                                </div>


                                <div class="text-right col-lg-6">
                                    <div>
                                        @if( $showAdminPassword )
                                            <p><b>{{ $adminPassword }}</b></p>
                                        @else
                                            <p><b>{{ str_repeat('*', strlen($adminPassword)) }}</b> <a wire:click="$set('showAdminPassword', true)" style="cursor: pointer;">show</a></p>
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

                                <div class="text-left col-lg-8">
                                    <div>
                                        <b>Account Monthly Price</b>
                                    </div>
                                </div>


                                <div class="text-right col-lg-4">
                                    <div>
                                        <b>{{ $accountPrice }}/</b><small>month</small>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <div >
                                        <b>Allow Create Account</b>
                                    </div>
                                </div>

                                <div class="text-right col-lg-3">
                                    <div>
                                        <div class="switch">
                                            <label><input wire:model="allowAccountCreation"  type="checkbox" checked=""><span class="lever switch-col-deep-purple"></span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <div >
                                        <b>Enable L2TP/IPSec</b>
                                    </div>
                                </div>

                                <div class="text-right col-lg-3">
                                    <div>
                                        <div class="switch">
                                            <label><input wire:model="enableL2TP"  type="checkbox" ><span class="lever switch-col-deep-purple"></span></label>
                                        </div>
                                    </div>
                                </div>


                                <div wire:target="allowAccountCreation,enableL2TP" wire:loading wire:loading.class="display-block"  data-waitme_id="170" style="background: rgba(255, 255, 255, 0.7);backdrop-filter: blur(.7px);text-align:center;">
                                    <div class="waitMe_content" style="margin-top: 0 auto;">
                                        <div class="waitMe_progress rotation" style="">
                                            <div class="waitMe_progress_elem1" style="border-color:#663AB7"></div>
                                        </div>
                                        <div class="waitMe_text" style="color:#663AB7">Saving...</div>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="col-lg-6">
                            <h4>UPDATE DETAILS</h4>
                            <hr>

                            <div class="clearfix row waitMe_container" data-waitme_id="169">


                                <div class="col-lg-12">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input wire:model="hubPassword" type="password" class="form-control">
                                            <label class="form-label">HUB Password</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input wire:model="adminPassword" type="password" class="form-control">
                                            <label class="form-label">Admin Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input wire:model="psk" type="password" class="form-control">
                                            <label class="form-label">IPSec Pre Shared Key (PSK)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input wire:model="accountPrice" type="text" class="form-control">
                                            <label class="form-label">Account Monthly Price</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">

                                    <div class="text-right">
                                        <button class="btn bg-deep-purple" wire:click="updateDetails">UPDATE DETAILS</button>
                                    </div>

                                </div>

                                <div wire:target="updateDetails" wire:loading wire:loading.class="display-block"  data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);backdrop-filter: blur(.7px);text-align:center;">
                                    <div class="waitMe_content" style="margin-top: 0px;">
                                        <div class="waitMe_progress rotation" style="">
                                            <div class="waitMe_progress_elem1" style="border-color:#663AB7"></div>
                                        </div>
                                        </br>
                                        <div class="waitMe_text" style="color:#663AB7">Updating...</div>
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
