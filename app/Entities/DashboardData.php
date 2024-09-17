<?php

namespace App\Entities;

class DashboardData
{
    public function __construct(
        private int $totalUser,
        private int $totalShortenedUrl
    )
    {
    }

    public function getTotalUser(): int
    {
        return $this->totalUser;
    }

    public function setTotalUser(int $totalUser): void
    {
        $this->totalUser = $totalUser;
    }

    public function getTotalShortenedUrl(): int
    {
        return $this->totalShortenedUrl;
    }

    public function setTotalShortenedUrl(int $totalShortenedUrl): void
    {
        $this->totalShortenedUrl = $totalShortenedUrl;
    }
}
