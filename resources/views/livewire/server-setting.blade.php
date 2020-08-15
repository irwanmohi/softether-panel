<div class="clearfix row" wire:init="prefetch">

    <style >
        .display-block {
            display: block !important;
        }


        @keyframes placeHolderShimmer{
            0%{
                background-position: -468px 0
            }
            100%{
                background-position: 468px 0
            }
        }

        .preloader-default {
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: placeHolderShimmer;
            animation-timing-function: linear;
            background: #f6f7f8;
            background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
            background-size: 800px 104px;
            height: 15px;
            position: relative;
        }
    </style>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-purple">
                <h2>
                    SERVER SETTING
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
                                        <b>Name</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $serverName }}</b>
                                    </div>

                                </div>


                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>IP Address</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        <b>{{ $serverAddress  }}</b>
                                    </div>

                                </div>

                                <div class="text-left col-lg-6">

                                    <div >
                                        <b>Country</b>
                                    </div>

                                </div>

                                <div class="text-right col-lg-6">

                                    <div >
                                        @if( ! $countryReadyToLoad )

                                            <div class="preloader-default">

                                            </div>

                                        @else

                                            <b>{{ $serverCountry }}</b>

                                        @endif
                                    </div>

                                </div>


                                <div wire:target="" wire:loading wire:loading.class="display-block"  data-waitme_id="170" style="background: rgba(255, 255, 255, 0.7);backdrop-filter: blur(.7px);text-align:center;">
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
                                            <input wire:model="serverName" type="text" class="form-control">
                                            <label class="form-label">Server Name</label>
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


                        <div class="col-lg-12">
                            <h4 class="col-red">DANGER ZONE</h4>
                            <hr>

                            <button class="btn btn-lg btn-danger" wire:click="$emit('openDeleteServerModal')">DELETE SERVER</button>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



    <div  class="modal fade " id="deleteServerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header bg-red">
                    <h4 class="mb-2 modal-title" id="defaultModalLabel">DELETE SERVER</h4>
                </div>
                <div class="modal-body">
                    <livewire:delete-server :server="$server" :key="$server->id">
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="text-white btn btn-link " style="color: #fff;" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

</div>




@push('scripts')
<script charset="utf-8">

    window.livewire.on('openDeleteServerModal', function(e) {
        $('#deleteServerModal').modal('show');
    })

</script>
@endpush
