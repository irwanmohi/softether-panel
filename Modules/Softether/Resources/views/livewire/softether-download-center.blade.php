<div class="clearfix row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-purple">
                <h2>
                    DOWNLOAD CENTER
                </h2>
            </div>
            <div class="body table-responsive">
                <div class="row-clearfix">
                    <div class="col-lg-12">

                        <div class="col-lg-12">

                            @if( $softetherAccount->auth_type == 'CERTIFICATE' )
                                <div class="alert bg-blue">
                                    L2TP over IPSec using Passwordless&#8482; is not supported for now, Disable Passwordless&#8482; if you want to use L2TP over IPSec!
                                </div>

                                <hr>
                            @endif

                        </div>

                        <div class="col-lg-6">

                            <h4>DOWNLOAD OPENVPN CONFIG</h4>
                            You can use this OpenVPN configuration file to connect to the VPN server using your favourite openvpn client.

                            <hr>
                            <button @if( in_array($softetherAccount->status, ['INACTIVE', 'CREATING', 'EXPIRED', 'FAILED']) ) disabled @endif wire:click="downloadOpenvpnConfig" style="width: 100%" class="btn bg-deep-purple"> <span>DOWNLOAD .OVPN FILE &nbsp; </span> <i class="material-icons">file_download</i> </button>
                        </div>

                        <div class="col-lg-6">
                            <h4>DOWNLOAD RSA KEY PAIR</h4>
                            Using key pair let you securely connect to the VPN Server with passwordless options.

                            <hr>
                            <button @if( in_array($softetherAccount->status, ['INACTIVE', 'CREATING', 'EXPIRED', 'FAILED']) ) disabled @endif wire:click="downloadCertificate" style="width: 100%" class="btn bg-deep-purple"> <span>DOWNLOAD CERTIFICATE &nbsp; </span> <i class="material-icons">file_download</i> </button>
                        </div>

                        <div class="col-lg-12">
                            <hr>
                            <small>* If you enable the <code>Passwordless</code> option on the Account menu, you don't need username & password while connecting to the VPN Server.</small>
                            <br>
                            <small>* If you enable the <code>Passwordless</code> option on the Account menu, you can't connect to the VPN Server using L2TP over IPSec. Since Softether not support this kind of authentication for now.</small>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
