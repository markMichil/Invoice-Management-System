<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\InvoiceRepositoryInterface::class,

            \App\Repositories\InvoiceRepository::class


        );

        $this->app->bind(
            \App\Interfaces\LogRepositoryInterface::class,
            \App\Repositories\LogRepository::class
        );

        $this->app->bind(
            \App\Interfaces\CustomerRepositoryInterface::class,
            \App\Repositories\CustomerRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
