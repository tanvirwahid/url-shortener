<?php

namespace App\Contracts\Repositories;

use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;

interface ShortUrlRepositoryInterface
{
    public function create(ShortUrlDto $dto): ShortUrl;
    public function getByShortUrl(string $shortUrl): ?ShortUrl;
}
