<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            // \App\Repositories\UserRepository::class,
        ];

        foreach ($repositories as $repository) {
            $this->app->bind($repository, $repository.'Eloquent');
        }
    }
}
