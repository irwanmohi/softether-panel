<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PluginInstall extends Model
{
    public function plugins() {
        return $this->hasMany(PluginInstallPlugin::class);
    }
}
