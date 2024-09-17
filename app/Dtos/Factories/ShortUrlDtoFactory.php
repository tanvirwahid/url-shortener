<?php

namespace App\Dtos\Factories;

use App\Contracts\ShortUrlDtoFactoryInterface;
use App\Dtos\ShortUrlDto;
use App\Http\Requests\ShortUrlCreationRequest;
use Carbon\Carbon;

class ShortUrlDtoFactory implements ShortUrlDtoFactoryInterface
{
    public function __construct(private ShortUrlDto $shortUrlDto)
    {}

    public function getShortUrlDto(ShortUrlCreationRequest $request): ShortUrlDto
    {
        $this->shortUrlDto->setOriginalUrl($request->get('original_url'))
            ->setExpiresAt(Carbon::now()->addDays(
                $request->filled('expiration') ? intval($request->get('expiration')) : 30
            ));

        if (auth()->check() && auth()->user()->email_verified_at != null) {
            $this->shortUrlDto->setIsPrivate(
                $request->filled('is_private') ? $request->get('is_private') : false
            )->setCreatedBy(auth()->id());

            if($request->filled('shortened_url')) {
                $this->shortUrlDto->setShortenedUrl($request->get('shortened_url'));
            }
        }

        return $this->shortUrlDto;
    }
}
