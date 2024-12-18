<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

use Illuminate\Events\Dispatcher;
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
    public function boot(Dispatcher $events): void
    {
        Schema::defaultStringLength(191);
    }
}
