<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $stats = [
            'totalQuotations'      => \App\Models\Quotation::count(),
            'totalUsers'           => \App\Models\User::count(),
            'thisYearQuotations'   => \App\Models\Quotation::whereYear('created_at', date('Y'))->count(),
            'totalQuotationAmount' => \App\Models\Quotation::sum('total_amount'),
            'totalItems'           => \App\Models\Product::count(),
            'customersTotal'       => \App\Models\Client::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
