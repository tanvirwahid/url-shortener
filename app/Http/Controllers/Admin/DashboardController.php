<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService)
    {
    }

    public function index()
    {
        $data = $this->dashboardService->getDashboardData();

        return view('admin.dashboard')->with([
            'totalUsers' => $data->getTotalUser(),
            'totalShortenedUrl' => $data->getTotalShortenedUrl()
        ]);
    }
}
