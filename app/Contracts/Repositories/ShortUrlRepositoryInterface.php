<?php

namespace App\Contracts\Repositories;

use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;
use Illuminate\Pagination\LengthAwarePaginator;

interface ShortUrlRepositoryInterface
{
    public function index(int $perPage = 10): LengthAwarePaginator;
    public function findById(int $id): ShortUrl; 
    public function addShortenedUrl(ShortUrl $shortUrl, string $shortenedUrl);
    public function create(ShortUrlDto $dto): ShortUrl;
    public function getByShortUrl(string $shortUrl): ?ShortUrl;
    public function deleteExpiredUrls();
    public function getTotal(): int;
}
