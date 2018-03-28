<?php

namespace Ensphere\Gnaw\Providers;

use Ensphere\Gnaw\Console\Commands\FrontDevBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


    }

    /**
     * THESE ARE APPLICATION CONTRACTS.
     * REGISTER MODULE CONTRACTS IN THE REGISTRATION FILE SO THEY CAN BE EXTENDED PER APPLICATION
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            FrontDevBuilder::class
        ]);
    }

}
