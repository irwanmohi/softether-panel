@if( $resellers->isEmpty() )

    <div class="clearfix row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        RESELLERS
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RESELLER NAME</th>
                                <th>RESELLER EMAIL</th>
                                <th>RESELLER BALANCE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">

                                    <h2>NO RESELLER HAS BEEN CREATED</h2>
                                    @if($standalone)
                                        <a href="{{ route('reseller-plugin.resellers.create') }}" class="btn bg-deep-purple btn-lg">CREATE NEW RESELLER</a>
                                    @endif

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
                        RESELLERS
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RESELLER NAME</th>
                                <th>RESELLER EMAIL</th>
                                <th>RESELLER BALANCE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resellers as $reseller)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $reseller->name }}</td>
                                    <td>{{ $reseller->email }}</td>
                                    <td><label class="label bg-deep-purple">{{ $reseller->balance }}</label></td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-danger waves-effect"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Delete Reseller"
                                            data-original-title="Delete Reseller"
                                            wire:click="$emit('deleteReseller', {{ $reseller->id }})"
                                        >
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn bg-purple waves-effect"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Add Balance"
                                            data-original-title="Add Balance"
                                            wire:click="$emit('addBalanceToReseller', {{ $reseller->id }})"
                                        >
                                            <i class="material-icons">account_balance_wallet</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endif
@push('scripts')

<script charset="utf-8">

    document.addEventListener('DOMContentLoaded', function() {

        @this.on('deleteReseller', function(id) {

            swal({
                title: "Are you sure?",
                text: "All reseller data will be deleted and cannot be reverted back.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    @this.call('deleteReseller', id)

                    swal({
                        title: "Deleted!",
                        text: "Reseller has been deleted!",
                        icon: "success",
                    });
                } else {
                    swal({
                        title: "Canceled",
                        text: 'Reseller has not been deleted.'
                    });
                }
            });

        })

        @this.on('addBalanceToReseller', function(id) {
            swal({
                text: 'Enter the amount',
                content: "input",
                input: 'number',
                button: {
                    text: "Submit",
                    closeModal: false,
                },
            })
            .then(amount => {
                if (!amount) {
                    return swal("Please enter an amount", "", "error")
                }

                if(! parseInt(amount) ) {
                    return swal("Please enter valid amount", "", "error")
                }

                @this.call('addBalanceToReseller', id, parseInt(amount))

                return new Promise(function(resolve, reject) {
                    setTimeout(resolve, 1000);
                })

            })
            .then(json => {

                var previousBalance = @this.get('previousBalance'),
                    newBalance = @this.get('newBalance');

                if( newBalance > previousBalance ) {
                    swal({
                        title: "Success!",
                        text: 'Balance added successfully!',
                        icon: 'success'
                    });
                }
                else
                {
                    swal("Failed!", "Please make sure your balance is enough!", "error");
                }

            })
        })

    })

</script>

@endpush
