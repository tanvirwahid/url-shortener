<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UrlShortenerService;

class ShortUrlController extends Controller
{
    public function __construct(private UrlShortenerService $urlService)
    {
    }

    public function index()
    {
        $data = $this->urlService->index();

        return view('admin.all_urls')->with([
            'urls' => $data
        ]);
    }
}
