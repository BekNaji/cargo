<?php

namespace App\Providers;

use App\Models\Cargo;
use App\Models\Shipping;
use App\Observers\CargoObserver;
use App\Observers\ShippingObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Cargo::observe(CargoObserver::class);
        Shipping::observe(ShippingObserver::class);
    }
}
