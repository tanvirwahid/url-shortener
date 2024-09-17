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

    public function generate(int $id): string
    {
        $shortUrl = $this->shortUrlRepository->findById($id);

        $shortenedUrl = $this->base62Converter->encodeToBase62(
            $this->uniqueIdGenerator->createUniqueId()
        );

        $this->shortUrlRepository->addShortenedUrl($shortUrl, $shortenedUrl);

        return $shortenedUrl;
    }

    public function getOriginalUrl(string $shortUrl): ?ShortUrl
    {
        return $this->shortUrlRepository->getByShortUrl($shortUrl);
    }

    public function store(ShortUrlDto $shortUrlDto): ShortUrl
    {
        return $this->shortUrlRepository->create($shortUrlDto);
    }

    public function deleteExpiredUrls()
    {
        $this->shortUrlRepository->deleteExpiredUrls();
    }
}
