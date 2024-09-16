<?php

namespace App\Providers;

use App\Contracts\Repositories\UniqueIdRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Repositories\UniqueIdRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            UniqueIdRepositoryInterface::class,
            UniqueIdRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
