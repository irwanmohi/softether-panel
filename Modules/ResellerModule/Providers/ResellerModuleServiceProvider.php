<?php

namespace Modules\ResellerModule\Providers;

use Alert;
use Infobox;
use Livewire;
use MenuManager;
use App\Contracts\Concerns\Colors;
use App\Contracts\SideMenu;
use App\Contracts\Concerns\Link;
use App\Contracts\Infobox as InfoboxContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\ResellerModule\Livewire\EditReseller;
use Modules\ResellerModule\Livewire\ResellerTable;
use Modules\ResellerModule\Widgets\ResellerTableWidget;

class ResellerModuleServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'ResellerModule';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'resellermodule';

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

        // app level
        $this->registerMenu();
        $this->registerBoxes();

        // livewire
        $this->registerLivewireComponents();

        // widgets
        $this->registerWidgets();
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

    protected function registerMenu() {
        $adminMenu = [
            app(SideMenu::class)->setName('Reseller Setting')->setUrl('/admin/reseller-setting')
        ];

        foreach ($adminMenu as $menu) {
            MenuManager::adminMenu($menu);
        }
    }

    protected function registerBoxes() {
        //
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('reseller-table', ResellerTable::class);
        Livewire::component('edit-reseller', EditReseller::class);
    }

    protected function registerWidgets() {
        app('arrilot.widget-namespaces')->registerNamespace('resellermoduleWidget', '\Modules\ResellerModule\Widgets');
    }
}
