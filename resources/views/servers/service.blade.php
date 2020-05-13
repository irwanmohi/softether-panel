<div class="col-md-4 col-lg-4">
    <div class="card">
        <div class="header
            @if($status == 'ONLINE')
                bg-green
            @elseif($status == 'OFFLINE')
                bg-red
            @else
                bg-grey
            @endif
        ">
            <h2 class="text-center">
                {{ $name }} - <span>{{ $status }}</span>
            </h2>
        </div>
        <div class="body">
            <h1 class="text-center"><span >{{ $status }}</span></h1>
        </div>
    </div>
</div>
