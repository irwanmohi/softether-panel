<div class="card">
    <div class="body">

        <h2 class="card-inside-title">Follow instructions below to install {{ $softwareName }}</h2>

        <hr />

        <div class="clearfix row">

            <div class="col-md-12">

                <h4>1. SSH TO YOUR SERVER</h4>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">code</i> SSH
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#how_to_ssh" data-toggle="tab">
                            <i class="material-icons">info_outline</i> HOW TO SSH?
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                        <p style="font-weight: bold;">SSH to your server by running command below:</p>
                        <pre class="bash">ssh {{ sprintf("root@%s", $server->ip) }} </pre>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="how_to_ssh">
                        <b>How to SSH from Linux or Mac?</b>
                        <br>
                        <p>
                            If you are using Mac/Linux or any <code>*nix</code> operating system, simply open the Terminal app, and run command below.
                        </p>
                        <pre class="bash">ssh {{ sprintf("root@%s", $server->ip) }} </pre>

                        <hr>

                        <b>How to SSH from Windows?</b>
                        <br></br>

                        <ol >
                            <li >Download PuTTY <a href="https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html">Here</a></li>
                            <li>Install the PuTTY by double-click the file you downloaded earlier and follow the installation instructions.</li>
                            <li style="padding: 5px;">
                                Open the PuTTY app, and it will looks like image below
                                <img src="https://images.ctfassets.net/0lvk5dbamxpi/3128zvPEmpHTiBw8mDQj5w/fcc8610ddf64e53cbef743190984afe8/PuTTY_Windows_configuration_and_connection_screen_with_profile_save_option" class="img-responsive" alt="">
                            </li>
                            <li>
                                Enter your server ip address <code>{{ $server->ip }}</code> on the <b>Host Name</b> field on the PuTTY app.
                            </li>
                            <li>
                                Enter <code>22</code> on the <b>Port</b> field, or the <code>sshd</code> port if you changed it.
                            </li>
                            <li>
                                Then click the button <b>Open</b>. It will open the terminal with black screen asking for your server password.
                            </li>
                        </ol>

                    </div>
                </div>

                <hr>

                <!-- CUSTOM SCRIPT -->

                <h4>2. RUN THE AUTO INSTALLER</h4>
                <pre class="bash">{{ $script }}</pre>

            </div>

        </div>

    </div>
</div>


