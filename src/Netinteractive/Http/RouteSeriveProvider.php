<?php  namespace Netinteractive\Http;

use Illuminate\Support\ServiceProvider;

/**
 * Class RouteSeriveProvider
 * @package Netinteractive\Http
 */
class RouteSeriveProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishPublic();
        $this->publishConfigs();
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigs();
    }

    /**
     * Publishes views
     */
    protected function publishConfigs()
    {
        $config = __DIR__.'/../../config/combiner.php';
        $this->publishes([
            $config => config_path('/packages/netinteractive/http/combiner.php'),
        ], 'config');
    }

    /**
     * Registers configs
     */
    protected function registerConfigs()
    {
        $config = __DIR__.'/../../config/combiner.php';
        $this->mergeRecursiveConfigFrom($config, 'packages.netinteractive.combiner.config');
    }


    /**
     * Publishes public assets
     */
    protected function publishPublic()
    {
        $this->publishes([
            __DIR__ . '/../../assets/js' => public_path('packages/netinteractive/http/')
        ], 'public');

    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function mergeRecursiveConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, array_merge_recursive(require $path, $config));
    }
}