<?php

namespace MWGuerra\CrudArtisan;

use Illuminate\Support\ServiceProvider;
use MWGuerra\CrudArtisan\Console\CrudArtisanCommand;

class CrudArtisanServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudArtisanCommand::class,
            ]);
        }
    }
}
