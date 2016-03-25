<?php namespace Netinteractive\Http;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerResponseFactory();
    }

    /**
     * Register the response factory implementation.
     *
     * @return void
     */
    protected function registerResponseFactory()
    {
        $this->app->singleton('Illuminate\Contracts\Routing\ResponseFactory', function ($app) {
            return new ResponseFactory($app['Illuminate\Contracts\View\Factory'], $app['redirect']);
        });
    }
}