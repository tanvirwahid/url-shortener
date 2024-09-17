<?php

namespace App\Services\Admin;

use App\Contracts\Repositories\ShortUrlRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Entities\DashboardData;

class DashboardService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ShortUrlRepositoryInterface $shortUrlRepository
    )
    {
    }

    public function getDashboardData()
    {
        return new DashboardData(
            $this->userRepository->getTotal(),
            $this->shortUrlRepository->getTotal()
        );
    }
}
