<div id="edit-setting-container">

    <form action="/modal/settings/{{ $setting->id }}" id="edit-setting" method="POST" accept-charset="utf-8">
        @method('put')
        @csrf

        <p>{{ $setting->display_name }} :</p>

        @if( $setting->kind == 'boolean' )
            <div class="switch" style="margin-top: 20px">
                <label>
                    NO
                    <input value="{{  ($setting->encrypted) ? decrypt($setting->value) : $setting->value  }}" id="setting_switch" name="value" type="checkbox" {{ (bool) $setting->value ? 'checked' : '' }}>
                    <span class="lever switch-col-orange"></span>
                    YES
                </label>
            </div>
        @else
            <div class="form-group">
                <div class="form-line">
                    <input style="padding-left: 5px !important" type="text" name="value" class="form-control" placeholder="Setting Value" value="{{  ($setting->encrypted) ? decrypt($setting->value) : $setting->value  }}">
                </div>
            </div>
        @endif
        <hr />
        <div class="text-right">
            <button class="float-right btn btn-success" type="submit" >SAVE CHANGES</button>
        </div>
    </form>
</div>


<script charset="utf-8">

    $('#edit-setting').on('submit', function(e) {
        e.preventDefault()

        $('#edit-setting-container').hide();

        $('.modal-loader').fadeIn();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $('#edit-setting').serialize(),
            success: function(d) {
                $('#setting_modal').modal('hide');

                swal('Setting Updated!', '', 'success')
            },
            error: function(e) {
                $('#setting_modal').modal('hide');

                swal('FAIL!', 'Unexpected Error Happen!', 'error')
            }
        });


    })

</script>

