@extends('layouts.master')
@section('title', 'Install Plugin')
@section('page_title', 'INSTALL NEW PLUGIN')
@section('css')
<style type="text/css" media="screen">


.wizard .steps .current a {
    background-color: #673AB7;
}

.wizard .steps .current a:active, .wizard .steps .current a:focus, .wizard .steps .current a:hover {
    background-color: #673AB7;
}

.wizard > .steps .current a {
    background: #673AB7;
    color: #fff;
    cursor: default;
}

.wizard > .steps .current a:hover, .wizard > .steps .current a:active {
    background: #673AB7;
    color: #fff;
    cursor: default;
}

.wizard > .steps .done a {
    background: rgba(103,58,183, .5);
    color: #fff;
}

.wizard > .steps .done a:hover, .wizard > .steps .done a:active {
    background: rgba(103,58,183, .5);
    color: #fff;
}

</style>
@endsection
@section('content')

<div class="clearfix row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>PLUGIN INSTALLER WIZARD</h2>
            </div>
            <div class="text-center body">
                <h3>FOR SECURITY REASON. PLUGIN INSTALLER ARE DISABLED IN DEMO MODE.</h3>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script charset="utf-8">

    var installerId = null;
    var plugins     = [];

    $(document).on('ready', function() {
        // request installer id.
        $.ajax({
            url: '{{ route("plugin-install.store") }}',
            type: 'POST',
            data: "_token={{ csrf_token() }}",
            success: function(d) {
                installerId = d.id
            },
            error: function(e) {
                return swal('Something Went Wrong!', 'Unable to fetch plugin installer data.', 'error');
            }
        });

    });

    var pluginStep = $('#wizard_vertical').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        stepsOrientation: 'horizontal',
        onInit: function (event, currentIndex) {
            setButtonWavesEffect(event);

            // remove previous button
            $(event.currentTarget).find('[role="menu"] li').remove('.disabled').attr('disabled', true);

            // disable the first next button until plugin is added
            $(event.currentTarget).find('[role="menu"] li').attr('aria-disabled', true).addClass('disabled').attr('disabled', true);

        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);

            // on step 2, initialize table
            if( currentIndex == 2 ) {

                // remove previous button
                $(event.currentTarget).find('[role="menu"] li').remove('.disabled').attr('disabled', true);

                // disable the first next button until plugin is added
                $(event.currentTarget).find('[role="menu"] li').attr('aria-disabled', true).addClass('disabled').attr('disabled', true);

            }
        }
    });

    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
    }

    Dropzone.options.pluginUpload = {
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        uploadMultiple: true,
        paramName: 'plugins',
        acceptedFiles: '.zip',
        init: function() {
            this.on('addedfile', function(e) {
                var wizard = $('#wizard_vertical');

                wizard.find('[role="menu"] li').attr('aria-disabled', false).removeClass('disabled');
            })

            this.on('sending', function(e, xhr, formData) {
                formData.append('installer_id', installerId)
            })

            this.on('success', function(d, res) {
                plugins = res.plugins;

                var pluginListHtml = '';

                plugins.forEach(function(d, i) {
                    pluginListHtml += '<tr><td>' + (parseInt(i) + 1) + '</td><td>' + d.plugin_name_formatted + '</td><td>' + d.plugin_description_formatted + '</td><td>' + d.can_be_installed + '</td></tr>'
                });

                $('#pluginList').html(pluginListHtml)
            })
        }
    }

    function installPlugins() {
        $('#button-install-plugin-container').hide();
        $('.modal-loader').show();

        $.ajax({
            url: '{{ route("plugin-install.executeInstaller") }}',
            type: 'POST',
            data: 'installer_id=' + installerId + '&_token={{ csrf_token() }}',
            success: function(d) {
                var pluginTableHtml = '';
                d.plugins.forEach(function(d, i) {
                    var currentRow = '<tr><td>' + (parseInt(i) + 1) + '</td><td>' + d.plugin_name + '</td><td>' + d.plugin_status + '</td>';

                    if( d.plugin_status == 'ERROR' ) {
                        currentRow += '<td><button class="btn bg-red waves-effect m-b-15" type="button" data-toggle="collapse" data-target="#errorCollapse'+ i +'" aria-expanded="false" aria-controls="collapseExample">SHOW ERROR LOG</button></td></tr>';
                        currentRow += '<tr><td colspan="5" style="padding:0 !important"><div class="collapse" id="errorCollapse' + i + '" aria-expanded="false"><div class="well">' + d.plugin_logs + '</div></div></td></tr>';

                    }
                    else
                    {
                        currentRow += '<td>-</td>'
                    }

                    pluginTableHtml += currentRow;

                })

                $('#plugin-success-list').html(pluginTableHtml);
                $('#plugin-success').show();

                pluginStep.steps('next');
            },
            error: function(e) {

                $('#plugin-failed').show();
                pluginStep.steps('next');
            }
        })
    }
</script>
@endsection
