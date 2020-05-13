<div class="clearfix row" >

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @livewire('server-services', ['server' => $server])
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @livewire('server-disks', ['server' => $server])
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @livewire('server-network', ['server' => $server])
    </div>
</div>
