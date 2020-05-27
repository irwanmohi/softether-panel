@if( $coupons->isEmpty() )

    <div class="clearfix row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        COUPONS
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CODE</th>
                                <th>AMOUNT</th>
                                <th>CREATED BY</th>
                                <th>IS USED</th>
                                <th>USED BY</th>
                                <th>EXPIRED AT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">

                                    <h2>NO COUPONS HAS BEEN CREATED</h2>
                                    <button  class="btn bg-deep-purple btn-lg" wire:click="$emit('GenerateNewCoupon')"><span>CREATE NEW COUPON</span> &nbsp; <i class="material-icons">card_giftcard</i></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@else

    <div class="clearfix row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        COUPONS
                        <small>Coupon is the easiest & profesional way to send balance to your reseller!</small>
                    </h2>

                    <ul class="header-dropdown m-r--5">
                        <a  class="btn bg-deep-purple " wire:click="$emit('GenerateNewCoupon')"><span>CREATE NEW COUPON</span> &nbsp; <i class="material-icons">card_giftcard</i></a>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CODE</th>
                                <th>AMOUNT</th>
                                <th>CREATED BY</th>
                                <th>IS USED</th>
                                <th>USED BY</th>
                                <th>EXPIRED AT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><b>{{ $coupon->coupon }}</b></td>
                                    <td><b>{{ $coupon->amount }}</b></td>
                                    <td>{{ user($coupon->created_by)->name }}</td>
                                    <td>{!! boolean_to_label($coupon->is_redeemed) !!}</td>
                                    <td>{{ is_null($coupon->redeemed_by) ? 'NOT REDEEMED YET' : user($coupon->redeemed_by)->name }}</td>
                                    <td>{{ is_null($coupon->valid_until) ? 'NEVER EXPIRED' : \Carbon\Carbon::parse($coupon->valid_until)->format('d/m/y H:i:s A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endif


<div  class="modal fade " id="coupon-generator-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">GENERATE NEW COUPON</h4>
            </div>
            <div class="modal-body">

                @livewire('coupon-generator')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>



@push('scripts')

<script charset="utf-8">

    window.livewire.on('GenerateNewCoupon', function() {

        $('#coupon-generator-modal').modal('show');

    })


    window.livewire.on('CouponCreated', function(coupon) {
        $('#coupon-generator-modal').modal('hide');
    })


</script>

@endpush
