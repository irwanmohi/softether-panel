<?php

namespace App\Jobs;

use File;
use PhpZip\ZipFile;
use App\PluginInstall;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPluginInstaller implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $installer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PluginInstall $installer)
    {
        $this->installer = $installer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach( $this->installer->plugins as $plugin ) {
            if( $plugin->is_valid ) {

                $extractDir = base_path('Modules/' . $plugin->plugin_name);

                File::makeDirectory($extractDir, 0755, true, true);

                $zip = (new ZipFile())
                            ->openFile(storage_path('/app/' . $plugin->final_path))
                            ->extractTo($extractDir);


                // execute plugin hooks.

                $pluginJson = json_decode(
                    file_get_contents($extractDir . '/module.json'), true
                );

                try {

                    if(
                        isset($pluginJson['hooks']['onInstall']) &&
                        is_array( $pluginJson['hooks']['onInstall'] )
                    ) {

                        foreach($pluginJson['hooks']['onInstall'] as $onInstallHook) {

                            $hook = explode("@", $onInstallHook);


                            // invalid hook, ignore.
                            if( empty($hook) ) continue;

                            if( count($hook) < 2 ) {
                                // doesn't have method assigned, trigger __invoke instead.
                                $hook[] = '__invoke';
                            }

                            $hookAction = app()->call(
                                [app($hook[0]), $hook[1]]
                            );

                        }

                    }

                    $plugin->update(['plugin_status' => 'INSTALLED']);

                } catch(\Exception $e) {

                    // Delete the plugin directory.

                    File::deleteDirectory($extractDir);

                    $logs = sprintf("%s %s :\n%s",
                        get_class($e),
                        $e->getMessage(),
                        $e->getTraceAsString()
                    );

                    $plugin->update([
                        'plugin_status' => 'ERROR',
                        'plugin_logs'   => $logs
                    ]);

                }
            }
        }
    }
}
