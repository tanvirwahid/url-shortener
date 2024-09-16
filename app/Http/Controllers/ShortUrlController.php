<?php

namespace App\Http\Controllers;

use App\Dtos\ShortUrlDto;
use App\Http\Requests\ShortUrlCreationRequest;
use App\Services\UrlShortenerService;
use Carbon\Carbon;

class ShortUrlController extends Controller
{
    public function __construct(private UrlShortenerService $urlShortenerService)
    {}

    public function refirect($shortUrl)
    {
        $url = $this->urlShortenerService->getOriginalUrl($shortUrl);

        if($url === null || $url->expires_at < Carbon::now())
        {
            abort(404);
        }

        return redirect()->away($url->original_url);
    }

    public function store(ShortUrlCreationRequest $request, ShortUrlDto $shortUrlDto)
    {
        $shortUrlDto->setOriginalUrl($request->get('original_url'))
            ->setExpiresAt(Carbon::now()->addDays(
                $request->filled('expiration') ? $request->get('expiration') : 30
            ));

        if (auth()->check()) {
            $shortUrlDto->setIsPrivate(
                $request->filled('is_private') ? $request->get('is_private') : false
            )->setCreatedBy(auth()->id());
        }

        $url = $this->urlShortenerService->generate($shortUrlDto);

        return view('view-shortened-url')->with(['url' => $url]);
    }
}
