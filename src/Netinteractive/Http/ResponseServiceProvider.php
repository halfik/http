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
        $this->app->bind('ni.http.response', function () {
            return new Response();
        });

        $this->app->booting(function()
        {
            AliasLoader::getInstance()->alias('NiResponse','Netinteractive\Http\Facades\ResponseFacade');
        });
    }
}