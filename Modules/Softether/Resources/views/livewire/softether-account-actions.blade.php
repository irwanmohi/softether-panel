<div>

    <a
        type="button"
        class="btn btn-sm bg-pink waves-effect"
        data-toggle="tooltip"
        data-placement="top"
        title="View Account Details"
        data-original-title="View Account Details"
        href="{{ route('softether.accounts.show', [encrypt($account->id)]) }}"

    >
    <i class="material-icons">remove_red_eye</i>
    </a>

    <button
        type="button"
        class="btn btn-sm bg-deep-purple waves-effect"
        data-toggle="tooltip"
        data-placement="top"
        title="Edit Account Details"
        data-original-title="Edit Account Details"
        wire:click="$emit('OpenAccountEditModal', {{ $account->id }})"
    >
    <i class="material-icons">mode_edit</i>

    </button>
    <button
        type="button"
        class="btn btn-sm btn-danger waves-effect"
        data-toggle="tooltip"
        data-placement="top"
        title="Delete VPN Account"
        data-original-title="Delete VPN Account"
        wire:click="$emit('deleteAccount', {{ $account->id }})"
    >
    <i class="material-icons">delete</i>

    </button>

    @if( $accountLocked )

        <button
            type="button"
            class="btn btn-sm bg-green waves-effect"
            data-toggle="tooltip"
            data-placement="top"
            title="Unlock VPN Account"
            data-original-title="Unlock VPN Account"
            wire:click="$emit('unlockAccount', {{ $account->id }})"
        >
        <i class="material-icons">lock_open</i>

        </button>

    @else

        <button
            type="button"
            class="btn btn-sm bg-blue waves-effect"
            data-toggle="tooltip"
            data-placement="top"
            title="Lock VPN Account"
            data-original-title="Lock VPN Account"
            wire:click="$emit('lockAccount', {{ $account->id }})"
        >
        <i class="material-icons">lock</i>

        </button>

    @endif
</div>

<!-- GENERATE BASE MODAL -->
<div  class="modal fade " id="edit-vpn-account-modal-{{ $account->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">EDIT VPN ACCOUNT</h4>
            </div>
            <div class="modal-body">
                <livewire:edit-softether-account :account="$account" :key="$account->id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!-- END BASE MODAL -->

<script charset="utf-8">

    @if( $index == 1 )

        $(document).ready(function() {
            //Tooltip
            $('[data-toggle="tooltip"]').tooltip({container: 'body'});

            //Popover
            $('[data-toggle="popover"]').popover();

        });


        window.livewire.on('AccountUpdated', () => {
            $('.modal').modal('hide');
        });

    @endif

    @this.on('OpenAccountEditModal', function(id) {
        $('#edit-vpn-account-modal-' + id).modal('show');
    })

    @this.on('deleteAccount', function(id) {
        swal({
            title: "Are you sure?",
            text: "All account data will be deleted and cannot be reverted back.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                @this.call('deleteAccount', id)

                swal({
                    title: "Deleted!",
                    text: "VPN Account has been deleted!",
                    icon: "success",
                });
            } else {
                swal({
                    title: "Canceled",
                    text: 'VPN Account has not been deleted.'
                });
            }
        });

    })

    @this.on('lockAccount', function(id) {
        swal({
            title: "Are you sure?",
            text: "The user will not able to connect using this account.",
            icon: "warning",
            button: {
                closeModal: false
            },
            dangerMode: true,
            closeModal: false,
            closeOnClickOutside: false
        })
        .then((willDelete) => {
            if (willDelete) {

                @this.call('lockAccount', id)

                return new Promise(function(resolve, reject) {
                    @this.on('AccountUpdated', function() {
                        resolve()
                    })
                })

            } else {
                swal({
                    title: "Canceled",
                    text: 'VPN Account has not been locked.'
                });
            }
        })
        .then((locked) => {
            swal({
                title: "Locked!",
                text: "VPN Account has been locked!",
                icon: "success",
            });
        })
        .catch(err => {
            console.log(err)
        })


    })


    @this.on('unlockAccount', function(id) {
        swal({
            title: "Are you sure?",
            text: "The user will be able to connect again using this account.",
            icon: "warning",
            button: {
                closeModal: false
            },
            dangerMode: true,
            closeModal: false,
            closeOnClickOutside: false
        })
        .then((willDelete) => {
            if (willDelete) {

                @this.call('unlockAccount', id)

                return new Promise(function(resolve, reject) {
                    @this.on('AccountUpdated', function() {
                        resolve()
                    })
                })

            } else {
                swal({
                    title: "Canceled",
                    text: 'VPN Account has not been unlocked.'
                });
            }
        })
        .then((unlocked) => {
            swal({
                title: "Unlocked!",
                text: "VPN Account has been unlocked!",
                icon: "success",
            });
        })
        .catch(err => {
            console.log(err)
        })

    })
</script>



