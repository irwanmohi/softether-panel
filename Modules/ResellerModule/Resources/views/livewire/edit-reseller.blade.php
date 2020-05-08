<div id="edit-reseller-container" class="waitMe_container" data-waitme_id="169">

    @if($errors->count() > 0)
        <div wire:loading.remove wire:target="updateResellerDetails" class="alert alert-danger" id="error-alert">

            Please fix the following errors:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <div class="clearfix row">
        <div class="col-md-12">
            <div class="input-group">

                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input wire:model="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ $reseller->name }}" required>
                </div>

            </div>
        </div>
    </div>
    <div class="clearfix row">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">contact_mail</i>
                </span>
                <div class="form-line">
                    <input wire:model="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ $reseller->email }}" required>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix row">
        <div class="col-md-12">
            <div class="input-group">

                <span class="input-group-addon">
                    <i class="material-icons">fingerprint</i>
                </span>
                <div class="form-line">
                    <input wire:model="password" type="password" class="form-control" placeholder="Password (Leave blank unedited)" name="password" >
                </div>

            </div>
        </div>
    </div>


    <div class="clearfix row">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">account_balance_wallet</i>
                </span>
                <div class="form-line">
                    <input wire:model="balance" type="number" class="form-control" placeholder="Balance" name="balance" value="{{ (int) $reseller->balance }}" required>
                </div>
                <span class="input-group-addon">.00</span>
            </div>
        </div>
    </div>

    <div class="clearfix row">

        <div class="text-right" >
            <div class="col-md-12">
                <button wire:click="updateResellerDetails({{ $reseller->id }})"  class="btn bg-deep-purple p-l-50 p-r-50" >SAVE</button>
            </div>
        </div>

    </div>

    <div wire:loading wire:target="updateResellerDetails" class="waitMe" data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);">
        <div class="waitMe_content" style="margin-top: 0px;">
            <div class="waitMe_progress rotation" style="">
                <div class="waitMe_progress_elem1" style="border-color:#663AB7"></div>
            </div>
            <div class="waitMe_text" style="color:#663AB7">Updating...</div>
        </div>
    </div>

</div>


@push('scripts')

    <script charset="utf-8">

        document.addEventListener('DOMContentLoaded', function() {
            @this.on('resellerUpdated', function() {
                var isUpdated = +@this.get('updated');

                if(isUpdated) {
                    swal("Success!", "Reseller Updated Successfully!", "success");
                }
            })
        })

    </script>


@endpush
