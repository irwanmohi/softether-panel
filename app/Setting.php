<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value', 'encrypted'
    ];

    public function getValueAttribute($value) {
        if( $this->encrypted ) {
            try {
                return decrypt($value);
            } catch(\Exception $e) {
                return;
            }
        }

        return $value;
    }
}
