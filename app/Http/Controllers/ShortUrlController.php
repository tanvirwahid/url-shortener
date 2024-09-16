<?php

namespace App\Http\Controllers;

use App\Contracts\ShortUrlDtoFactoryInterface;
use App\Http\Requests\ShortUrlCreationRequest;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    public function __construct(
        private UrlShortenerService $urlShortenerService,
        private ShortUrlDtoFactoryInterface $shortUrlDtoFactory
    )
    {}

    public function refirect($shortUrl, Request $request)
    {
        return redirect()->away($request->url);
    }

    public function store(ShortUrlCreationRequest $request)
    {
        $url = $this->urlShortenerService->generate(
            $this->shortUrlDtoFactory->getShortUrlDto($request)
        );

        return view('view-shortened-url')->with(['url' => $url]);
    }
}
