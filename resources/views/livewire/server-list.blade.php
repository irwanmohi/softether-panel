<div class="clearfix row">
    @foreach($this->servers as $server)
        @livewire('server-card', ['server' => $server])
    @endforeach
</div>
