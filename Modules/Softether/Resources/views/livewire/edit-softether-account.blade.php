<div id="edit-reseller-container" class="waitMe_container" data-waitme_id="169">

    @if( session()->has('error_message') )
        <div class="alert alert-danger" id="error-alert">
            {!! session('error_message') !!}
        </div>
    @endif

    @if($errors->count() > 0)
        <div wire:loading.remove class="alert alert-danger" id="error-alert">

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
            <div class="input-group form-float">

                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input wire:model="password" type="text" class="form-control" placeholder="Password" name="password" value="{{ $password }}" required>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="clearfix row">
        <div class="col-sm-12">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                </span>
                <select wire:model="duration" class="form-control show-tick">
                    <option value="0">-- ADD ACCOUNT DURATION --</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option
                            value="{{ $i }}"
                            @if( ! user()->isAdmin() && user()->balance < ($i * $softetherServer->account_price) )
                                disabled
                            @endif
                            >

                            {{ $i }} MONTH

                            @if( ! user()->isAdmin() && user()->balance < ($i * $softetherServer->account_price) )
                                <small> - not enough balance</small>
                            @endif

                        </option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="clearfix row">

        <div class="text-right" >
            <div class="col-md-12">
                <button wire:click="updateAccountDetails"  class="btn bg-deep-purple p-l-50 p-r-50" >SAVE</button>
            </div>
        </div>

    </div>

    <div wire:loading wire:target="updateAccountDetails" class="waitMe" data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);">
        <div class="waitMe_content" style="margin-top: 0px;">
            <div class="waitMe_progress rotation" style="">
                <div class="waitMe_progress_elem1" style="border-color:#663AB7"></div>
            </div>
            <div class="waitMe_text" style="color:#663AB7">Saving...</div>
        </div>
    </div>

</div>

<script charset="utf-8">

    window.livewire.hook('afterDomUpdate', () => {
        $('select').selectpicker();
    });

    @this.on('AccountUpdated', function() {
        var isUpdated = +@this.get('updated');

        if(isUpdated) {
            swal("Success!", "Account Updated Successfully!", "success");
        }
    })


</script>


