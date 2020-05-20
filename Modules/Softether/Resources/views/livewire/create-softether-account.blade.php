<div class="clearfix row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <h2 class="card-inside-title">Enter Account Details</h2>
                <hr />

                @if( session()->has('error_message') )
                    <div class="alert alert-danger" id="error-alert">
                        {!! session('error_message') !!}
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
                                    <i class="material-icons">perm_identity</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="username" type="text" class="form-control" placeholder="Username" required>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if( ! $softetherServer->passwordless_only )

                        <div class="clearfix row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-line">
                                        <input wire:model="password" type="password" class="form-control" placeholder="Password" name="ip" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif

                    <div class="clearfix row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <select wire:model="duration" class="form-control show-tick">
                                    <option value="0">-- SELECT ACCOUNT DURATION --</option>
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


                    <div class="clearfix text-right row">
                        <div class="col-md-12">
                            <button type="submit" class="btn bg-deep-purple p-l-50 p-r-50" type="submit" id="btn-create-account">CREATE</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-purple">
                <h2>
                    SUMMARY
                </h2>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Account Price / Month</td>
                            <td>{{ $softetherServer->account_price }}</td>
                        </tr>
                        @if( ! is_null($duration) && $duration != 0)

                            <tr>
                                <td>{{ $duration }} Month Account Rent ({{ $softetherServer->account_price }} X {{ $duration }} Month)</td>
                                <td>{{ $accountPrice }}</td>
                            </tr>

                        @endif

                        <th>
                            <td colspan="2"><b>Total</b></td>
                        </th>

                        <tr>
                            <td >Final Price</td>
                            <td style="font-weight: bold;">{{ $accountPrice }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@push('scripts')

<script charset="utf-8">
    window.livewire.on('SoftetherAccountCreated', function(e) {
    })

    window.livewire.hook('afterDomUpdate', () => {
        $('select').selectpicker();
    });

    window.livewire.on('SoftetherAccountCreated', function(account, redirect) {
        console.log(account, redirect)
        alert('account created')
    })

</script>

@endpush
