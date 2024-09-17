<?php

namespace App\Contracts\Repositories;

use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;
use Illuminate\Pagination\LengthAwarePaginator;

interface ShortUrlRepositoryInterface
{
    public function index(int $perPage = 10): LengthAwarePaginator;
    public function create(ShortUrlDto $dto): ShortUrl;
    public function getByShortUrl(string $shortUrl): ?ShortUrl;
    public function deleteExpiredUrls();
    public function getTotal(): int;
}
