<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        dd('teste');
        $this->app->bind(
            \ModelLayer\Repositories\OrderRepository::class,
            \ModelLayer\Repositories\OrderRepositoryEloquent::class
//            \ModelLayer\Repositories\OrderRepositoryDoctrine::class
        );


    }
}
