<div class="clearfix row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <h2 class="card-inside-title">Redeem Gift Code</h2>
                <hr />

                @if( session()->has('coupon_message') )

                    <div class="alert alert-success">
                        {{ session('coupon_message') }}
                    </div>

                @endif

                @if( session()->has('error_message') )

                    <div class="alert alert-danger">
                        {{ session('error_message') }}
                    </div>

                @endif

                @if($errors->count() > 0)
                    <div class="alert alert-danger" id="error-alert">
                        Please fix the following errors:
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form wire:submit.prevent="submit">

                    @csrf

                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">

                                <span class="input-group-addon">
                                    <i class="material-icons">card_giftcard</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="code" type="text" class="form-control" placeholder="Gift Code" name="code" required>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="clearfix text-right row">
                        <div class="col-md-12">
                            <button class="btn bg-deep-purple p-l-50 p-r-50" type="submit" id="btn-create-reseller">REDEEM</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@push('scripts')

    <script charset="utf-8">

        window.livewire.on('CouponRedeemed', function(coupon) {
            swal("Redeemed!", "The " + coupon.amount + " amount of balance is added to your account!", "success")
        })

    </script>

@endpush
