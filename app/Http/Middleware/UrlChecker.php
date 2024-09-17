<?php

namespace App\Http\Middleware;

use App\Services\UrlShortenerService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UrlChecker
{
    public function __construct(private UrlShortenerService $urlShortenerService)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $shortUrl = $request->route('shortUrl');

        $url = $this->urlShortenerService->findByShortUrl($shortUrl);

        if($url === null || $url->expires_at < Carbon::now())
        {
            abort(404);
        }

        if($url->is_private)
        {
            if(!auth()->check() || $url->user_id != auth()->id())
            {
                abort(404);
            }
        }

        $request->merge([
            'url' => $url->original_url
        ]);

        return $next($request);
    }

}
