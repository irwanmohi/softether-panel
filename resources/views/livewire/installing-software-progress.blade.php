<div class="card" wire:poll.100ms="refreshSetup">
    <div class="body">

        <div class="clearfix row">

            <div class="col-md-12">

                <h4>Installing Software</h4>

                <hr>

                <div class="alert bg-blue">
                    Your server is being installed right now, you can wait or close this tab. It might take a few minutes.
                </div>

                <br>

                <h5 class="text-center">{{ strtoupper($server->status) }}</h5>

                <div class="progress">
                    <div class="progress-bar bg-deep-purple progress-bar-striped active" role="progressbar" aria-valuenow="{{ $server->setup_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $server->setup_percentage }}%">
                        {{ $server->setup_percentage }}%
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


