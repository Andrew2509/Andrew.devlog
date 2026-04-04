<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Inquiry;
use App\Models\Price;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_portfolio' => \App\Models\Portfolio::count(),
            'total_inquiries' => \App\Models\Inquiry::count(),
            'total_prices' => \App\Models\Price::count(),
            'total_clients' => \App\Models\Client::count(),
            'total_categories' => \App\Models\ServiceCategory::count(),
            'latest_inquiries' => \App\Models\Inquiry::latest()->take(5)->get(),
            'latest_portfolios' => \App\Models\Portfolio::latest()->take(5)->get(),
            'new_inquiries_count' => \App\Models\Inquiry::where('status', 'new')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
