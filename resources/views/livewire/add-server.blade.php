<div class="clearfix row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <h2 class="card-inside-title">Enter Server Details</h2>
                <hr />

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
                                    <i class="material-icons">reorder</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="serverName" type="text" class="form-control" placeholder="Server Name" name="name" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">settings_input_component</i>
                                </span>
                                <div class="form-line">
                                    <input wire:model="serverIP" type="text" class="form-control" placeholder="IP Address (xxx.xxx.xxx.xxx)" name="ip" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix text-right row">
                        <div class="col-md-12">
                            <button class="btn bg-deep-purple p-l-50 p-r-50" type="submit" id="btn-create-reseller">CREATE</button>
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
                    Before Adding New Server
                </h2>
            </div>
            <div class="body">
                Before you add new server, please make sure your server is :
                <hr />
                <ol>
                    <li>Make sure your server is <b>CLEAN</b> no VPN Software is installed.</li>
                    <li>Make sure your server is running on <b>Ubuntu 16</b> or  <b>Ubuntu 18</b>.</li>
                    <li>Make sure your server is not running behind another VPN or NAT.</li>
                    <li>Make sure your server is not OpenVZ based containerization.</li>
                </ol>
            </div>
        </div>
    </div>
</div>
