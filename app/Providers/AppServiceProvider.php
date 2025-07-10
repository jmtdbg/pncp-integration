<?php

namespace App\Providers;

use App\Models\Check;
use App\Observers\CheckObserver;
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
        date_default_timezone_set(config('app.timezone')); // 👈 força o timezone correto
        Check::observe(CheckObserver::class);
    }
}
