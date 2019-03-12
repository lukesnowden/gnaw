<?php

namespace LukeSnowden\Gnaw\Providers;

use LukeSnowden\Gnaw\Console\Commands\FrontDevBuilder;
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
        $this->publishes( [
            __DIR__ . '/../configs/buttons.php' => config_path( 'gnaw/buttons.php' ),
            __DIR__ . '/../configs/colors.php' => config_path( 'gnaw/colors.php' ),
            __DIR__ . '/../configs/container.php' => config_path( 'gnaw/container.php' ),
            __DIR__ . '/../configs/form.php' => config_path( 'gnaw/form.php' ),
            __DIR__ . '/../configs/spacing.php' => config_path( 'gnaw/spacing.php' ),
            __DIR__ . '/../configs/table.php' => config_path( 'gnaw/table.php' ),
            __DIR__ . '/../configs/text.php' => config_path( 'gnaw/text.php' ),
        ], 'config' );

        $this->publishes( [ __DIR__ . '/../../resources/components/' => resource_path( 'views/gnaw' ) ] );

        $this->mergeConfigFrom( __DIR__ . '/../configs/buttons.php', 'gnaw.buttons' );
        $this->mergeConfigFrom( __DIR__ . '/../configs/colors.php', 'gnaw.colors' );
        $this->mergeConfigFrom( __DIR__ . '/../configs/container.php', 'gnaw.container' );
        $this->mergeConfigFrom( __DIR__ . '/../configs/form.php', 'gnaw.form' );
        $this->mergeConfigFrom( __DIR__ . '/../configs/spacing.php', 'gnaw.spacing' );
        $this->mergeConfigFrom( __DIR__ . '/../configs/table.php', 'gnaw.table' );
        $this->mergeConfigFrom( __DIR__ . '/../configs/text.php', 'gnaw.text' );
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
