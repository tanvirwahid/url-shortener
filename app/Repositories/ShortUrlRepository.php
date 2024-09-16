<?php

namespace App\Repositories;

use App\Contracts\Repositories\ShortUrlRepositoryInterface;
use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;

class ShortUrlRepository implements ShortUrlRepositoryInterface
{
    public function __construct(private ShortUrl $shortUrl)
    {}

    public function create(ShortUrlDto $dto): ShortUrl
    {
        return $this->shortUrl->create([
            'original_url' => $dto->getOriginalUrl(),
            'shortened_url' => $dto->getShortenedUrl(),
            'is_private' => $dto->isPrivate() ? 1 : 0,
            'expires_at' => $dto->getExpiresAt(),
            'user_id' => $dto->getCreatedBy()
        ]);
    }

    public function getByShortUrl(string $shortenedUrl): ?ShortUrl
    {
        return $this->shortUrl->where('shortened_url', $shortenedUrl)->first();
    }


}
