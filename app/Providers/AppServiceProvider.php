<?php

namespace App\Providers;

use App\Contracts\ShortUrlDtoFactoryInterface;
use App\Contracts\UniqueIdGeneratorInterface;
use App\Dtos\Factories\ShortUrlDtoFactory;
use App\Services\BasicUniqueIdGeneratorService;
use Illuminate\Support\Facades\Gate;
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

        $this->app->bind(
            ShortUrlDtoFactoryInterface::class,
            ShortUrlDtoFactory::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('add-private-url', function () {
            return $this->isValidated();
        });

        Gate::define('set-expiry-date', function () {
            return $this->isValidated();
        });

        Gate::define('set-custom-url', function() {
            return $this->isValidated();
        });

        Gate::define('view-created-urls', function() {
            return auth()->check();
        });
    }

    private function isValidated()
    {
        return auth()->check() && auth()->user()->email_verified_at != null;
    }
}
