<div class="clearfix row">

    @if( empty($servers) )
        <h3 class="text-center">NO SERVERS FOUND</h3>
    @else

        @foreach($servers as $server)
            @livewire('softether-server-card', ['softetherServer' => $server])
        @endforeach

    @endif


</div>
