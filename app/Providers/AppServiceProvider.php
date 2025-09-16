<?php

namespace App\Providers;

use App\Models\Orders;
use App\Observers\OrderObserver;
use Spatie\DbDumper\Databases\MySql;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Orders::observe(OrderObserver::class);
        if ($this->app->environment('local')) {
            MySql::create()
                ->setDumpBinaryPath('C:\\xampp\\mysql\\bin');
        }
    }
}
