<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPlugin;
use App\Jobs\ProcessPluginInstaller;
use App\PluginInstall;
use Illuminate\Http\Request;

class PluginInstallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pluginInstall = PluginInstall::create([]);

        return response()->json($pluginInstall);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadPluginFile(Request $request) {

        $request->validate(['installer_id' => 'required|exists:plugin_installs,id']);

        $installer = PluginInstall::with('plugins')->find($request->installer_id);

        foreach($request->plugins as $plugin) {
            $pluginPath = $plugin->store('plugins');

            ProcessPlugin::dispatch($installer, $pluginPath, $plugin->getClientOriginalName());
        }

        return response()->json([
            'installer' => $installer,
            'plugins' => $installer->fresh()->plugins->map(function($plugin) {
                $plugin->can_be_installed = boolean_to_label($plugin->is_valid);
                $plugin->plugin_name_formatted = empty($plugin->plugin_name) ? 'UNKNOWN' : $plugin->plugin_name;
                $plugin->plugin_description_formatted = empty($plugin->plugin_description) ? 'UNKNOWN' : $plugin->plugin_description;

                return $plugin;
            })
        ]);
    }

    public function executeInstaller(Request $request) {
        $request->validate(['installer_id' => 'required|exists:plugin_installs,id']);

        $installer = PluginInstall::with('plugins')->find($request->installer_id);

        ProcessPluginInstaller::dispatch($installer);

        return response()->json([
            'message' => 'ok',
            'plugins' => $installer->fresh()->plugins
        ]);
    }
}
