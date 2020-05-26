@if( $admins->isEmpty() )

    <div class="clearfix row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMIN
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>BALANCE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">

                                    <h2>NO ADMIN UNDER YOUR MANAGEMENT</h2>

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
                        ADMIN
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>BALANCE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->balance }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-danger waves-effect"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Delete Admin"
                                            data-original-title="Delete Admin"
                                            wire:click="$emit('deleteAdmin', {{ $admin->id }})"
                                            wire:key="edit-reseller"
                                        >
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-warning waves-effect"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Revert Admin to non-Admin user"
                                            data-original-title="Revert Admin to non-Admin user"
                                            wire:click="$emit('convertToNonAdmin', {{ $admin->id }})"
                                            wire:key="edit-reseller"
                                        >
                                            <i class="material-icons">pan_tool</i>
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

        @this.on('deleteAdmin', function(id) {

            swal({
                title: "Are you sure?",
                text: "This admin user will be deleted!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            })
            .then((willDelete) => {
                if (willDelete) {

                    @this.call('deleteAdmin', id)

                    swal({
                        title: "Deleted!",
                        text: "Admin has been deleted!",
                        icon: "success",
                    });
                } else {
                    swal({
                        title: "Canceled",
                        text: 'Admin has not been deleted.'
                    });
                }
            });

        })

        @this.on('convertToNonAdmin', function(id) {

            swal({
                title: "Are you sure?",
                text: "This reseller will become regular user / reseller and cannot modify panel details.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            })
            .then((willDelete) => {
                if (willDelete) {

                    @this.call('convertToNonAdmin', id)

                    swal({
                        title: "Done!",
                        text: "Admin is now regular user!",
                        icon: "success",
                    });
                } else {
                    swal({
                        title: "Canceled",
                        text: 'Admin has not been reverted.'
                    });
                }
            });

        })
    })

    @this.on('AdminUpdated', function() {
        swal("Success!", "Admin has been updated!", "success")
    })

    @this.on('AdminDeleted', function() {
        swal("Success!", "Admin has been deleted!", "success")
    })

</script>

@endpush
