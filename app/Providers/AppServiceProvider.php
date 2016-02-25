<?php

namespace App\Providers;

use App\ModelLayer\Repositories\OrderRepositoryInterface;
use App\Models\Doctrine\Repositories\OrderRepositoryDoctrine;
use App\Models\Doctrine\Entities\Order;
use App\Models\Eloquent\Repositories\OrderRepositoryEloquent;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class,
            OrderRepositoryEloquent::class
            /*
            function($app) {
                // This is what Doctrine's EntityRepository needs in its constructor.
                return new OrderRepositoryDoctrine($app['em'], $app['em']->getClassMetaData(Order::class));
            } //*/
        );
    }
}
