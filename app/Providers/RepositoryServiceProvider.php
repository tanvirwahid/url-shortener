<?php

namespace App\Providers;

use App\Contracts\Repositories\ShortUrlRepositoryInterface;
use App\Contracts\Repositories\UniqueIdRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Repositories\ShortUrlRepository;
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

        $this->app->bind(
            ShortUrlRepositoryInterface::class,
            ShortUrlRepository::class
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
