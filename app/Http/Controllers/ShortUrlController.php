<?php

namespace App\Http\Controllers;

use App\Contracts\ShortUrlDtoFactoryInterface;
use App\Http\Requests\ShortUrlCreationRequest;
use App\Jobs\UrlShortener;
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
        $url = $this->urlShortenerService->store(
            $this->shortUrlDtoFactory->getShortUrlDto($request)
        );

        return view('view-shortened-url')->with(['url' => $url]);
    }

    public function generate(int $id)
    {
        UrlShortener::dispatch(
            $this->urlShortenerService,
            $id
        )->onQueue(config('url-shortener.queue'));

        return response()->json([
            'message' => 'Successfully pushed to queue'
        ]);
    }
}
