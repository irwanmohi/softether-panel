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
                    SHARING
                </h2>
            </div>
            <div class="body table-responsive">
                <div class="row-clearfix">
                    <div class="col-lg-12">

                        <h4>SHARING URL</h4>
                        <p>You can share URL below to your client, so your client can download their own certificate & get access to their account without requiring to contact you!</p>

                        <div class="clearfix row">


                            <div class="col-lg-12">

                                <hr>

                                <div class="clearfix row waitMe_container" data-waitme_id="169">

                                    <div class="text-left col-lg-3">

                                        <div >
                                            <b>URL</b>
                                        </div>

                                    </div>

                                    <div class="text-right col-lg-9">

                                        <div >
                                            <b class="col-grey"><a  href="{{ $softetherAccount->sharing_url }}">{{ $softetherAccount->sharing_url }}</a></b>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div style="font-weight: bold;">
                                            Enable Sharing
                                        </div>
                                    </div>

                                    <div class="text-right col-lg-6">
                                        <div>
                                            <div class="switch">
                                                <label><input wire:model="enableSharing"  type="checkbox" checked=""><span class="lever switch-col-deep-purple"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div wire:target="enableSharing" wire:loading wire:loading.class="display-block"  data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);backdrop-filter: blur(.7px);text-align:center;">
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



</div>


@push('scripts')
<script charset="utf-8">

    window.livewire.on('UpdatingSoftetherAccountDetails', function(e) {
            {{--alert('updating');--}}
    })
</script>
@endpush
