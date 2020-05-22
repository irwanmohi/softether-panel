<?php

namespace Modules\Softether\Providers;

use Livewire;
use App\Facades\ServerUtils;
use Modules\Softether\Http\Livewire\SoftetherAccountDetailsPublic;
use Modules\Softether\Http\Livewire\SoftetherAccountRow;
use Modules\Softether\Http\Livewire\SoftetherAccountActions;
use Modules\Softether\Http\Livewire\SoftetherAccountListLoader;
use Modules\Softether\Http\Livewire\SelectSoftetherServer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Softether\Http\Livewire\CreateSoftetherAccount;
use Modules\Softether\Http\Livewire\EditSoftetherAccount;
use Modules\Softether\Http\Livewire\ShowSoftetherAccountDetails;
use Modules\Softether\Http\Livewire\SoftetherAccountList;
use Modules\Softether\Http\Livewire\SoftetherAccountSetting;
use Modules\Softether\Http\Livewire\SoftetherDownloadCenter;
use Modules\Softether\Http\Livewire\SoftetherHowToConnect;
use Modules\Softether\Http\Livewire\SoftetherServerCard;
use Modules\Softether\Services\RegisterServerCertificateHookAction;
use Modules\Softether\Services\SoftetherSoftware;

class SoftetherServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Softether';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'softether';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerLivewireComponents();
        $this->registerHookActions();

        ServerUtils::addSoftware('softether-vpn', SoftetherSoftware::class);


    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    protected function registerLivewireComponents() {
        Livewire::component('select-softether-server', SelectSoftetherServer::class);
        Livewire::component('softether-server-card', SoftetherServerCard::class);
        Livewire::component('create-softether-account', CreateSoftetherAccount::class);
        Livewire::component('show-softether-account-details', ShowSoftetherAccountDetails::class);
        Livewire::component('softether-how-to-connect', SoftetherHowToConnect::class);
        Livewire::component('softether-download-center', SoftetherDownloadCenter::class);
        Livewire::component('softether-account-setting', SoftetherAccountSetting::class);
        Livewire::component('softether-account-list', SoftetherAccountList::class);
        Livewire::component('softether-account-list-loader', SoftetherAccountListLoader::class);
        Livewire::component('softether-account-actions', SoftetherAccountActions::class);
        Livewire::component('softether-account-row', SoftetherAccountRow::class);
        Livewire::component('edit-softether-account', EditSoftetherAccount::class);
        Livewire::component('softether-account-details-public', SoftetherAccountDetailsPublic::class);
    }

    protected function registerHookActions() {
        ServerUtils::registerHookAction('softether_register_server_certificate', RegisterServerCertificateHookAction::class);
    }
}


