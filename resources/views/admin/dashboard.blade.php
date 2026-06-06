@extends('admin.layouts.app')

@section('content')
<style>
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 16px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.08) !important;
    }
    .icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
</style>

<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
        <p class="text-secondary mb-0">Welcome, {{ auth()->guard('admin')->user()->name }}!</p>
    </div>

    <div class="row g-4">
        <!-- Total Quotation -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="card stat-card border-0 h-100 shadow-sm" style="border-left: 5px solid #4f46e5 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-uppercase text-xs fw-bold text-muted tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Quotation</span>
                        <div class="icon-box" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                            <i class="bi bi-file-earmark-pdf fs-4"></i>
                        </div>
                    </div>
                    <h2 class="mb-1 fw-bold text-dark">{{ $stats['totalQuotations'] }}</h2>
                    <p class="text-muted text-xs mb-0" style="font-size: 0.8rem;">All generated quotations</p>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="card stat-card border-0 h-100 shadow-sm" style="border-left: 5px solid #10b981 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-uppercase text-xs fw-bold text-muted tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total User</span>
                        <div class="icon-box" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                    </div>
                    <h2 class="mb-1 fw-bold text-dark">{{ $stats['totalUsers'] }}</h2>
                    <p class="text-muted text-xs mb-0" style="font-size: 0.8rem;">Registered system users</p>
                </div>
            </div>
        </div>

        <!-- This Year's Quotations -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="card stat-card border-0 h-100 shadow-sm" style="border-left: 5px solid #3b82f6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-uppercase text-xs fw-bold text-muted tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.05em;">This Year Total Quotation</span>
                        <div class="icon-box" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="bi bi-calendar3 fs-4"></i>
                        </div>
                    </div>
                    <h2 class="mb-1 fw-bold text-dark">{{ $stats['thisYearQuotations'] }}</h2>
                    <p class="text-muted text-xs mb-0" style="font-size: 0.8rem;">Generated in {{ date('Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Quotation Amount -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="card stat-card border-0 h-100 shadow-sm" style="border-left: 5px solid #ef4444 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-uppercase text-xs fw-bold text-muted tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Quotation Amount</span>
                        <div class="icon-box" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                    </div>
                    <h2 class="mb-1 fw-bold text-dark text-truncate" style="font-size: 1.5rem;" title="{{ number_format($stats['totalQuotationAmount'], 2) }} ৳">
                        {{ number_format($stats['totalQuotationAmount'], 2) }} ৳
                    </h2>
                    <p class="text-muted text-xs mb-0" style="font-size: 0.8rem;">Cumulative values</p>
                </div>
            </div>
        </div>

        <!-- Total Items -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="card stat-card border-0 h-100 shadow-sm" style="border-left: 5px solid #f59e0b !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-uppercase text-xs fw-bold text-muted tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Items</span>
                        <div class="icon-box" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                    </div>
                    <h2 class="mb-1 fw-bold text-dark">{{ $stats['totalItems'] }}</h2>
                    <p class="text-muted text-xs mb-0" style="font-size: 0.8rem;">Active products in catalog</p>
                </div>
            </div>
        </div>

        <!-- Customers Total -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
            <div class="card stat-card border-0 h-100 shadow-sm" style="border-left: 5px solid #8b5cf6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-uppercase text-xs fw-bold text-muted tracking-wider" style="font-size: 0.75rem; letter-spacing: 0.05em;">Customers Total</span>
                        <div class="icon-box" style="background-color: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="bi bi-building fs-4"></i>
                        </div>
                    </div>
                    <h2 class="mb-1 fw-bold text-dark">{{ $stats['customersTotal'] }}</h2>
                    <p class="text-muted text-xs mb-0" style="font-size: 0.8rem;">Client relationships</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
