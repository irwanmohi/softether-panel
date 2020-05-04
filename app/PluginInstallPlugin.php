<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PluginInstallPlugin extends Model
{

    protected $guarded = [];

    protected $casts = [
        'is_valid' => 'boolean',
        'plugin_premium' => 'boolean'
    ];

    public function pluginInstall() {
        return $this->belongsTo(PluginInstall::class);
    }
}
