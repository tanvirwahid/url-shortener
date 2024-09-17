<?php

namespace App\Jobs;

use App\Events\UrlShortened;
use App\Services\UrlShortenerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UrlShortener implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private UrlShortenerService $urlShortenerService,
        private int $id
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $shortenedUrl = $this->urlShortenerService->generate($this->id);
        Log::info(config('app.url').'/'.$shortenedUrl);
        event(new UrlShortened(config('app.url').'/'.$shortenedUrl, $this->id));
    }
}
