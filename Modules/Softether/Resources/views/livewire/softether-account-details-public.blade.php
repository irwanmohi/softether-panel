@section('css')
<style type="text/css" media="screen">
/*!
* bootstrap-vertical-tabs - v1.1.0
* https://dbtek.github.io/bootstrap-vertical-tabs
* 2014-06-06
* Copyright (c) 2014 Ä°smail Demirbilek
* License: MIT
*/
.nav-tabs, .tabs-right {
    border-bottom: none;
    padding-top: 2px;
}

.tabs-right {
    border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
    float: none;
    margin-bottom: 2px;
}

.tabs-right>li {
    margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
    background-color: transparent;
    color: #673AB7 !important;
    border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
    background-color: #673AB7;
    border-left-color: transparent;
}
.tabs-left>li>a {
    margin-right: 0;
    display:block;
}
.tabs-right>li>a {
    border-radius: 0 4px 4px 0;
    margin-right: 0;
}
.vertical-text {
    margin-top:50px;
    border: none;
    position: relative;
}
.vertical-text>li {
    height: 20px;
    width: 120px;
    margin-bottom: 100px;
}
.vertical-text>li>a {
    border-bottom: 1px solid #673AB7;
    border-right-color: transparent;
    text-align: center;
    border-radius: 4px 4px 0px 0px;
}

.vertical-text.tabs-left {
    left: -50px;
}
.vertical-text.tabs-right {
    right: -50px;
}
.vertical-text.tabs-right>li {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
}
.vertical-text.tabs-left>li {
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    transform: rotate(-90deg);
}
.nav-tabs > li  > a:before {
    border-bottom: none;
}

.nav-tabs > li .active > a {
    color: #673AB7 !important;
    background-color: transparent !important;

}


.nav-tabs > li.active > a,
.nav-tabs > li.active > a:hover,
.nav-tabs > li.active > a:focus {
    color: #673AB7 !important;
    cursor: default;
    background-color: transparent !important;
    border-bottom-color: transparent;
}

</style>
@endsection
<div  wire:init="loadData" >

    <div class="row-clearfix">

        <div class="col-lg-12">


            <div class="col-lg-12">

                <div wire:poll="refreshDetails" >

                    @if( ! $readyToLoad )
                        @livewire('server-boxes-loader')
                        @livewire('server-boxes-loader')
                    @else

                        @foreach(Infobox::getBoxes('accounts.' . $softetherAccount->softether_server_id . '.' . $softetherAccount->id) as $box)
                            {{ $box->getView() }}
                        @endforeach

                    @endif

                </div>

            </div>


        </div>

    </div>

    <div class="clearfix row" wire:ignore>

        <div class="col-lg-12">


            <div class="col-lg-1">
            </div>

            <div class="col-lg-10">

                <ul class="nav nav-tabs">
                    <li  class="active"><a href="#account-setting" data-toggle="tab">Account</a></li>
                    <li><a href="#download-center" data-toggle="tab">Downloads</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div wire:ignore class="tab-pane active" id="account-setting">
                        @livewire('softether-account-setting', ['softetherAccount' => $softetherAccount])
                    </div>
                    <div wire:ignore  class="tab-pane" id="download-center">
                        @livewire('softether-download-center', ['softetherAccount' => $softetherAccount])
                    </div>
                </div>
            </div>

            <div class="col-lg-1">
            </div>

        </div>

    </div>

    <div class="clearfix row">

        <div class="col-lg-12">

            <hr>
            <p class="text-center col-grey">Powered & Copyright by <a style="color: #673AB7;" href="https://sshpanel.io">SSHPANEL.io</a></p>

        </div>

    </div>


</div>

