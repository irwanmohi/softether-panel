<div class="clearfix row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-deep-purple">
                <h2>
                    DISK TABLE
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>MOUNT POINT</th>
                            <th>SPACES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( empty($disks) )
                            <tr>
                                <td colspan="2" class="text-center">

                                    <h2>UNABLE TO FETCH THE DISK INFORMATION</h2>

                                </td>
                            </tr>
                        @else


                            @foreach($disks as $disk)
                                <tr>
                                    <td style="width: 20%"><code>{{ $disk['mount_point'] }}</code></td>
                                    <td>

                                        <div class="progress">
                                            <div data-toggle="tooltip" title="Available Disk Space ({{ $disk['available_disk_space'] }})" class="progress-bar bg-deep-purple progress-bar-striped active" style="width: {{ $disk['available_disk_percentage'] }}%">
                                                Free ({{ $disk['available_disk_space'] }})
                                            </div>
                                            <div data-toggle="tooltip" title="Used Disk Space ({{ $disk['used_disk_space'] }})" class="progress-bar progress-bar-warning progress-bar-striped active" style="width: {{ $disk['used_disk_percentage'] }}%">
                                                Used ({{ $disk['used_disk_space'] }})
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                            @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
