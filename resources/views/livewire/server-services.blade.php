<div class="clearfix row" wire:init="registerServices">

    @if( ! $readyToLoad )
        @livewire('server-services-loader')
    @else

        @if(empty($services))
            <h1 class="text-center">NO SERVICE RUNNING IN THIS SERVER</h1>
        @else
            @foreach($services as $service)
                {{ $service->getView() }}
            @endforeach
        @endif

    @endif


</div>
