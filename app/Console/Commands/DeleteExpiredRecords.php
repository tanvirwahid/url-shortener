<?php

namespace App\Console\Commands;

use App\Jobs\DeleteExpiredUrls;
use App\Services\UrlShortenerService;
use Illuminate\Console\Command;

class DeleteExpiredRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-expired-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DeleteExpiredUrls::dispatch(app()->make(UrlShortenerService::class));
    }
}
