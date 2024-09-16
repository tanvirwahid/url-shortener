<?php

namespace App\Providers;

use App\Contracts\UniqueIdGeneratorInterface;
use App\Services\BasicUniqueIdGeneratorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UniqueIdGeneratorInterface::class,
            BasicUniqueIdGeneratorService::class
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
