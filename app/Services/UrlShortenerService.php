<?php

namespace App\Services;

use App\Base62Converter\Base62Converter;
use App\Contracts\Repositories\ShortUrlRepositoryInterface;
use App\Contracts\UniqueIdGeneratorInterface;
use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;

class UrlShortenerService
{
    public function __construct(
        private ShortUrlRepositoryInterface $shortUrlRepository,
        private UniqueIdGeneratorInterface  $uniqueIdGenerator,
        private Base62Converter             $base62Converter
    )
    {}

    public function index()
    {
        return $this->shortUrlRepository->index();
    }

    public function generate(ShortUrlDto $shortUrlDto)
    {
        return $this->shortUrlRepository->create(
            $shortUrlDto->setShortenedUrl(
                $this->base62Converter->encodeToBase62(
                    $this->uniqueIdGenerator->createUniqueId()
                )
            )
        );
    }

    public function getOriginalUrl(string $shortUrl): ?ShortUrl
    {
        return $this->shortUrlRepository->getByShortUrl($shortUrl);
    }

    public function deleteExpiredUrls()
    {
        $this->shortUrlRepository->deleteExpiredUrls();
    }
}
