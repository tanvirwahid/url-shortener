<?php

namespace App\Services;

use App\Base62Converter\Base62Converter;
use App\Contracts\Repositories\ShortUrlRepositoryInterface;
use App\Contracts\UniqueIdGeneratorInterface;
use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function getSelf(): LengthAwarePaginator
    {
        return $this->shortUrlRepository->getUrlsCreatedByAuthenticatedUser();
    }

    public function generate(int $id): string
    {
        $shortUrl = $this->shortUrlRepository->findById($id);

        $result = '';

        while(1) {
            $shortenedUrl = $this->base62Converter->encodeToBase62(
                $this->uniqueIdGenerator->createUniqueId()
            );

            if($this->findByShortUrl($shortenedUrl) == null) 
            {
                $result = $shortenedUrl;
                break;
            }
        }
        
        $this->shortUrlRepository->addShortenedUrl($shortUrl, $result);

        return $result;
    }

    public function findByShortUrl(string $shortUrl): ?ShortUrl
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
