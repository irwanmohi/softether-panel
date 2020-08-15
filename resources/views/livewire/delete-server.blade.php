<div  class="waitMe_container" data-waitme_id="169">

    <form wire:submit.prevent="submit">

        @csrf

        <div class="clearfix row">
            <div class="col-md-12">

                <h3 class="col-red">DANGER</h3>

                <p>You are going to delete server. all data related to server such as VPN account, config files, etc, will be deleted. This action is irreversible.</p>

                <p>In order to delete the server, you need to enter destruction code below.</p>
                </br>
                <p>DESTRUCTION CODE: <code>{{ $destructionCode }}</code></p>
                </br>

                <div class="input-group">

                    <span class="input-group-addon">
                        <i class="material-icons">warning</i>
                    </span>
                    <div class="form-line">
                        <input wire:model="enteredDestructionCode" type="text" class="form-control" placeholder="Destruction Code" required>
                    </div>

                </div>
            </div>
        </div>

        <div class="clearfix text-right row">
            <div class="col-md-12">
                <button disabled id="deleteButton" style="width: 100%;" type="submit" class="btn bg-red p-l-50 p-r-50" type="submit" id="btn-delete-server">DELETE</button>
            </div>
        </div>

        <div wire:loading wire:target="submit" class="waitMe" data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);">
            <div class="waitMe_content" style="margin-top: 0px;">
                <div class="waitMe_progress rotation" style="">
                    <div class="waitMe_progress_elem1" style="border-color:#F34336"></div>
                </div>
                <div class="waitMe_text" style="color:#F34336">Deleting...</div>
            </div>
        </div>

    </form>

</div>

@push('scripts')
<script charset="utf-8">

    window.livewire.on('enableDeleteButton', function(e) {
        $('#deleteButton').prop('disabled', false);
    })


    window.livewire.on('ServerDeleted', function(account, redirectUrl) {
        $('.modal').modal('hide');

        swal({
            title: "Server Deleted!",
            text: "Your server deleted successfully",
            icon: "success",
            buttons: [false, true],
            showCancelButton: false,
            dangerMode: true,
        })
        .then((created) => {
            if( created ) {
                window.location = '{{ url("/") }}'
            }
        });
    })

</script>
@endpush



