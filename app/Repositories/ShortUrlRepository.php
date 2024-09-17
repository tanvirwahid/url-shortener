<?php

namespace App\Repositories;

use App\Contracts\Repositories\ShortUrlRepositoryInterface;
use App\Dtos\ShortUrlDto;
use App\Models\ShortUrl;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ShortUrlRepository implements ShortUrlRepositoryInterface
{
    public function __construct(private ShortUrl $shortUrl)
    {
    }

    public function index(int $perPage = 10): LengthAwarePaginator
    {
        return $this->shortUrl
            ->active()
            ->paginate($perPage);
    }

    public function getUrlsCreatedByAuthenticatedUser(int $perPage = 10): LengthAwarePaginator
    {
        return $this->shortUrl->active()
            ->where('user_id', auth()->id())
            ->paginate($perPage);
    }

    public function create(ShortUrlDto $dto): ShortUrl
    {
        return $this->shortUrl->create([
            'original_url' => $dto->getOriginalUrl(),
            'is_private' => $dto->isPrivate() ? 1 : 0,
            'expires_at' => $dto->getExpiresAt(),
            'user_id' => $dto->getCreatedBy(),
            'shortened_url' => $dto->getShortenedUrl()
        ]);
    }

    public function findById(int $id): ShortUrl
    {
        return $this->shortUrl->find($id);
    }

    public function addShortenedUrl(ShortUrl $shortUrl, string $shortenedUrl)
    {
        $shortUrl->shortened_url = $shortenedUrl;
        $shortUrl->save();
    }

    public function getByShortUrl(string $shortenedUrl): ?ShortUrl
    {
        return $this->shortUrl->where('shortened_url', $shortenedUrl)->first();
    }

    public function deleteExpiredUrls()
    {
        $this->shortUrl->where('expires_at', '<', Carbon::now()->subHours(48))
            ->delete();
    }

    public function getTotal(): int
    {
        return $this->shortUrl->active()->count();
    }

    public function findShortUrlByOriginalUrl(string $originalUrl): LengthAwarePaginator
    {
        $activeUrls = ShortUrl::active()
            ->where('user_id', auth()->id())
            ->where('original_url', $originalUrl)
            ->select('shortened_url')
            ->paginate(10);

        $activeUrls->getCollection()->transform(function ($shortUrl) {
            return $shortUrl->url;
        });

        return $activeUrls;
    }
}
