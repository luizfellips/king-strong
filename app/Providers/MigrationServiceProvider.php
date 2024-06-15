<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // add onerepmax migrations folder to migrator
        $this->app->afterResolving(Migrator::class, function (Migrator $migrator) {
            $migrator->path(database_path('migrations/onerepmax'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
