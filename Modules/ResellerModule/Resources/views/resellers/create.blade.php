@extends('layouts.master')
@section('title', 'Create new Reseller')
@section('page_title', 'Create New Reseller')
@section('content')

<div class="clearfix row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <h2 class="card-inside-title">Specify Your {{ (user()->isAdmin()) ? 'Reseller' : 'Sub-Reseller' }} Details</h2>
                <hr />

                <div id="error-container" style="display:none">
                    <div class="alert alert-danger" id="error-alert">

                    </div>
                </div>

                <form id="reseller" action="{{ route('reseller-plugin.resellers.store') }}" method="post" accept-charset="utf-8">

                    @csrf

                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">

                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">contact_mail</i>
                                </span>
                                <div class="form-line">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">

                                <span class="input-group-addon">
                                    <i class="material-icons">fingerprint</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="clearfix row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_balance_wallet</i>
                                </span>
                                <div class="form-line">
                                    <input type="number" class="form-control" placeholder="Balance" name="balance"  required>
                                </div>
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix text-right row">
                        <div class="col-md-12">
                            <button class="btn bg-deep-purple p-l-50 p-r-50" type="submit" id="btn-create-reseller">CREATE</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @if(user()->role != 'admin')
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-deep-purple">
                    <h2>
                        Sub-Reseller Terms
                    </h2>
                </div>
                <div class="body">
                    Below is the terms that will be applied when you create sub-reseller.
                    <hr />
                    <ul>
                        <li>You will have access to all your sub-reseller resources, including created Account, Servers, IP Address, Balance, etc</li>
                        <li>The specified balance on the form will be deducted from your balance, make sure your balance enough to be transferred to your sub-reseller.</li>
                        <li>You can change your reseller password if they are forgotten their password.</li>
                        <li>You can deduct & add balance to your sub-reseller.</li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('js')

<script charset="utf-8">
    $(document).ready(function() {
        $('#reseller').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btn-create-reseller').text('CREATING...');
                    $('#btn-create-reseller').attr('disabled', true);
                    $('#error-container').hide();
                },
                success: function(d) {
                    $('#error-container').hide();
                    $('#btn-create-reseller').text('CREATE');
                    $('#btn-create-reseller').attr('disabled', false);

                    window.livewire.emit('userUpdated');

                    return swal('Reseller Created!', 'Reseller has been created successfully!', 'success');
                },
                error: function(e) {

                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                    $('#btn-create-reseller').text('CREATE');
                    $('#btn-create-reseller').attr('disabled', false);


                    if(e.responseJSON.errors) {

                        var htmlErrors = "<p>Please fix the following errors:</p><ul>";

                        for(var err in e.responseJSON.errors) {
                            e.responseJSON.errors[err].forEach(function(d, i) {

                                htmlErrors += '<li>' + d + '</li>'

                            })
                        }

                        htmlErrors += '</ul>'

                    }

                    $('#error-alert').html(htmlErrors);

                    $('#error-container').fadeIn();
                }
            });

        })

    }) ;
</script>

@endsection
