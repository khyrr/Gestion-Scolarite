<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Left Section: Title & Breadcrumb -->
        <div class="header-left flex-grow-1">
            <h1 class="page-title mb-0">@yield('title', 'Dashboard')</h1>
        </div>

        <!-- Right Section: Actions & Language Switcher -->
        <div class="header-right d-flex align-items-center gap-2">
            @include('admin.partials.header-actions')

            <!-- Notifications -->
            <div class="dropdown d-none d-lg-block">
                <x-dashboard.notifications />
            </div>

            <x-admin.lang-switcher />
        </div>
    </div>
</div>
