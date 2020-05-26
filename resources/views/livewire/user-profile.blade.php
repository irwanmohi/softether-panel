<div class="clearfix row">
    <div class="col-xs-12 col-sm-3">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <div class="image-area">
                    <img src="https://cataas.com/cat?width=150&height=150" class="" alt="">
                </div>
                <div class="content-area">
                    <h3>{{ $name }}</h3>
                    <p>{{ $email }}</p>
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>VPN Account</span>
                        <span>{{ $vpnAccounts }}</span>
                    </li>
                    <li>
                        <span>{{ user()->isAdmin() ? 'Reseller' : 'Sub-Reseller' }}</span>
                        <span>{{ $reseller }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <h2 class="card-inside-title">Update Account Details</h2>
                <hr />

                @if($errors->count() > 0)
                    <div wire:loading.remove wire:target="submit" class="alert alert-danger" id="error-alert">
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
                                    <i class="material-icons">account_box</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="name" type="text" class="form-control" placeholder="Name" name="name" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="email" type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="password" type="password" class="form-control" placeholder="Password (Leave blank unedited)" name="password" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix text-right row">
                        <div class="col-md-12">
                            <button class="btn bg-deep-purple p-l-50 p-r-50" type="submit" id="btn-create-reseller">UPDATE</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
<div>
@push('scripts')

<script charset="utf-8">

    window.addEventListener('DOMContentLoaded', function() {
        @this.on('userUpdated', function() {
            swal("Updated!", "User details has been updated!", "success")
        })
    })

</script>

@endpush
