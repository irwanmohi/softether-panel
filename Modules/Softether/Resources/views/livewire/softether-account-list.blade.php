<div wire:init="loadAccounts">

    @if( ! $readyToLoad )
        @livewire('softether-account-list-loader')
    @else

        <div class="clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header ">
                        <h2>
                            VPN ACCOUNTS
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>USERNAME</th>
                                    <th>SERVER</th>
                                    <th>STATUS</th>
                                    <th>ONLINE STATUS</th>
                                    <th>CREATED AT</th>
                                    <th>EXPIRED ON</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( $accounts->isEmpty() )

                                    <tr>
                                        <td colspan="7" class="text-center">

                                            <h2>NO VPN ACCOUNTS CREATED</h2>

                                        </td>
                                    </tr>
                                @else


                                    @foreach($accounts as $account)

                                        <tr>
                                            <td>{{ $account->username }}</td>
                                            <td>{{ optional($account->softetherServer->server)->name ?? 'UNKNOWN' }}</td>
                                            <td>

                                                @if($account->status == 'ACTIVE')
                                                    <label class="label label-success">ACTIVE</label>
                                                @endif

                                                @if($account->status == 'INACTIVE')
                                                    <label class="label label-danger">INACTIVE</label>
                                                @endif

                                                @if($account->status == 'FAILED')
                                                    <label class="label label-danger">FAILED</label>
                                                @endif

                                                @if($account->status == 'EXPIRED')
                                                    <label class="label label-warning">FAILED</label>
                                                @endif

                                                @if($account->status == 'CREATING')
                                                    <label class="label label-info">CREATING</label>
                                                @endif
                                            </td>
                                            <td>

                                                @if($account->online_status == 'ONLINE')
                                                    <label class="label label-success">ONLINE</label>
                                                @endif

                                                @if($account->online_status == 'OFFLINE')
                                                    <label class="label label-warning">OFFLINE</label>
                                                @endif

                                            </td>
                                            <td>{{ optional($account->created_at)->format('d/m/Y') }}</td>
                                            <td>{{ optional($account->expired_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @livewire('softether-account-actions', ['account' => $account, 'index' => $loop->index + 1], key(rand() * (int) $account->id))
                                            </td>
                                        </tr>

                                    @endforeach

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@push('scripts')
<script charset="utf-8">
    window.livewire.on('Details', function() {

    })
</script>
@endpush

