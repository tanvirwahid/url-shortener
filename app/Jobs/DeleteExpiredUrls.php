<?php

namespace App\Jobs;

use App\Services\UrlShortenerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteExpiredUrls implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private UrlShortenerService $urlShortenerService)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->urlShortenerService->deleteExpiredUrls();
    }
}
