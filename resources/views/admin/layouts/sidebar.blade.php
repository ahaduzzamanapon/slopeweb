<div class="sidebar d-flex flex-column">
    <div class="sidebar-header d-flex align-items-center justify-content-center border-bottom border-secondary border-opacity-25" style="padding: 11px;">
        @if(\App\Models\Setting::get('app_logo'))
            <img src="{{ asset('storage/' . \App\Models\Setting::get('app_logo')) }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
        @else
            <i class="bi bi-hexagon-fill fs-3 me-2 text-primary"></i>
        @endif
        <h4 class="mb-0 fw-bold tracking-tight">{{ \App\Models\Setting::get('app_name', config('app.name')) }}</h4>
    </div>
    
    <div class="sidebar-content flex-grow-1 overflow-auto py-3">
        <div class="px-3 mb-2 text-uppercase text-xs fw-bold opacity-50" style="font-size: 0.75rem; letter-spacing: 0.05em;">Content</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-speedometer2 me-2"></i> Dashboard</div>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-tags me-2"></i> Categories</div>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-box-seam me-2"></i> Products</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-tools me-2"></i> Services</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-images me-2"></i> Sliders</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-briefcase me-2"></i> Projects</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-people me-2"></i> Team Members</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-building me-2"></i> Our Clients</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.branches.index') }}" class="nav-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-geo-alt me-2"></i> Branches</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-chat-quote me-2"></i> Success Stories</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.quotations.index') }}" class="nav-link {{ request()->routeIs('admin.quotations.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-file-earmark-pdf me-2"></i> Quotations</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.terms-and-conditions.index') }}" class="nav-link {{ request()->routeIs('admin.terms-and-conditions.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-card-text me-2"></i> Terms & Conditions</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-envelope me-2"></i> Messages</div>
                </a>
            </li>
        </ul>

        <div class="px-3 mt-3 mb-2 text-uppercase text-xs fw-bold opacity-50" style="font-size: 0.75rem; letter-spacing: 0.05em;">Administration</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-person-lock me-2"></i> User Management</div>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.settings.general') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-gear me-2"></i> Settings</div>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer p-3 border-top border-secondary border-opacity-25">
        <a href="{{ route('admin.logout') }}" class="nav-link text-danger d-flex align-items-center justify-content-center p-2 rounded hover-bg-danger-subtle">
            <i class="bi bi-box-arrow-right me-2"></i>
            <span class="fw-medium">Logout</span>
        </a>
    </div>
</div>
