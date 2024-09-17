<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ShortUrlDtoFactoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlCreationRequest;
use App\Jobs\UrlShortener;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShortUrlController extends Controller
{
    public function __construct(
        private ShortUrlDtoFactoryInterface $dtoFactory,
        private UrlShortenerService $urlShortenerService
    )
    {
    }

    public function show(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        return response()->json([
           'data' => $this->urlShortenerService->findByOriginalUrl($request->get('original_url')),
           'message' => 'Successfully fetched'
        ]);
    }

    public function store(ShortUrlCreationRequest $request)
    {
        $shortUrl = $this->urlShortenerService
            ->store($this->dtoFactory->getShortUrlDto($request));

        if($request->filled('shortened_url'))
        {
            return response()->json([
               'data' => $shortUrl,
               'message' => 'Successfully Created'
            ], Response::HTTP_CREATED);
        }

        UrlShortener::dispatch(
            $this->urlShortenerService,
            $shortUrl->id
        )->onQueue(config('url-shortener.queue'));

        return response()->json([
            'data' => $shortUrl,
            'message' => 'Successfully pushed to queue'
        ], Response::HTTP_CREATED);
    }
}
