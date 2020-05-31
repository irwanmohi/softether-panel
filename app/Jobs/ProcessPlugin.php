<?php

namespace App\Jobs;

use Str;
use File;
use App\PluginInstall;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpZip\ZipFile;
use Storage;

class ProcessPlugin
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path, $originalName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PluginInstall $installer, $path, $originalName = null)
    {
        $this->installer = $installer;
        $this->path      = $path;
        $this->originalName = $originalName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $extractDir = storage_path('/app/plugins/extracted/' . Str::random(50));

        File::makeDirectory($extractDir, 0777, true, true);

        try {

            $zip = (new ZipFile())
                        ->openFile(storage_path('/app/' . $this->path))
                        ->extractTo($extractDir);

            $files = scandir($extractDir);

            $data = [
                'plugin_install_id' => $this->installer->id,
                'file_name' => basename($this->originalName),
                'final_file_name' => basename($this->path),
                'final_path' => $this->path,
                'extracted_directory' => $extractDir,
            ];

            if( ! in_array('module.json', $files) ) {

                Model::unguard();

                $pluginData = $data;

                $pluginData['is_valid'] = false;

                $this->installer->plugins()->create($pluginData);
            }
            else
            {
                $pluginData = $data;
                $json       = json_decode(file_get_contents($extractDir . '/module.json'), true);

                if( is_null($json) ) {

                    $pluginData['is_valid'] = false;

                    $this->installer->plugins()->create($pluginData);

                    return;
                }


                $pluginData['is_valid']    = true;
                $pluginData['plugin_name'] = isset($json['title']) ? $json['title'] : $json['name'];
                $pluginData['plugin_description'] = $json['description'];

                $this->installer->plugins()->create($pluginData);
            }



        } catch(\Exception $e) {
        }


    }
}
