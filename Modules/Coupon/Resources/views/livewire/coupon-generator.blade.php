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
        <div class="col-md-10">

            <div class="input-group form-float">

                <span class="input-group-addon">
                    <i class="material-icons">card_giftcard</i>
                </span>
                <div class="form-group form-float">
                    <div class="form-line ">
                        <input wire:model="code" type="text" class="form-control" placeholder="Code" name="code" value="" required>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-2">
            <div class="text-right">

                <button wire:click="generateRandomCode()" data-toggle="tooltip" data-title="Generate Random Code" type="button" class="btn bg-deep-purple btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">refresh</i>
                </button>

            </div>
        </div>
    </div>



    <div class="clearfix row">
        <div class="col-md-12">
            <div class="input-group form-float">

                <span class="input-group-addon">
                    <i class="material-icons">attach_money</i>
                </span>
                <div class="form-group form-float">
                    <div class="form-line ">
                        <input wire:model="amount" type="number" class="form-control" placeholder="Amount" name="amount" value="" required>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="clearfix row">
        <div class="col-md-12">
            <div class="input-group form-float">

                <span class="input-group-addon">
                    <i class="material-icons">subject</i>
                </span>
                <div class="form-group form-float">
                    <div class="form-line ">
                        <textarea wire:model="couponMessage" type="text" class="form-control" placeholder="Message when coupon is redeemed." name="message" value="" ></textarea>
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
                <select wire:model="expirationDate" class="form-control show-tick">
                    <option value="0">-- COUPON EXPIRATION DATE --</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option
                            value="{{ $i }}"
                            >

                            {{ $i }} MONTH

                        </option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="clearfix row">

        <div class="text-right" >
            <div class="col-md-12">
                <button wire:click="submit"  class="btn bg-deep-purple p-l-50 p-r-50" >CREATE</button>
            </div>
        </div>

    </div>

    <div wire:loading wire:target="submit" class="waitMe" data-waitme_id="169" style="background: rgba(255, 255, 255, 0.7);">
        <div class="waitMe_content" style="margin-top: 0px;">
            <div class="waitMe_progress rotation" style="">
                <div class="waitMe_progress_elem1" style="border-color:#663AB7"></div>
            </div>
            <div class="waitMe_text" style="color:#663AB7">Saving...</div>
        </div>
    </div>

</div>

@push('scripts')

    <script charset="utf-8">

        window.livewire.hook('afterDomUpdate', () => {
            $('select').selectpicker();
        });

        window.livewire.on('CouponCreated', function(coupon) {
            swal("Created!", "Coupon Created Successfully!", "success")
        })

    </script>

@endpush

