<div class="clearfix row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-purple">
                <h2>
                    NETWORK INTERFACES
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>INTERFACE</th>
                            <th>RX</th>
                            <th>TX</th>
                            <th>PACKET ERROR</th>
                            <th>PACKET DROPS</th>
                            <th>INFO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( empty($networkInterfaces) )
                            <tr>
                                <td colspan="6" class="text-center">

                                    <h2>UNABLE TO FETCH THE NETWORK INTERFACE INFORMATION</h2>

                                </td>
                            </tr>
                        @else


                            @foreach($networkInterfaces as $network)
                                <tr>
                                    <td>{{ $network['interface'] }}</td>
                                    <td>{{ $network['rx'] }}</td>
                                    <td>{{ $network['tx'] }}</td>
                                    <td>{{ $network['drop'] }}</td>
                                    <td>{{ $network['err'] }}</td>
                                    <td>{{ $network['info'] }}</td>
                                </tr>

                            @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
