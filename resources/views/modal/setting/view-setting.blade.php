<div>
    <p>{{ $setting->display_name }} :</p>

    @if( $setting->kind == 'boolean' )
        {!! boolean_to_label(($setting->encrypted) ? decrypt($setting->value) : $setting->value) !!}
    @else
        <p>{{ ($setting->encrypted) ? decrypt($setting->value) : $setting->value }}</p>
    @endif
</div>
