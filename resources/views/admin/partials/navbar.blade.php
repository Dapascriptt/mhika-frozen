<header class="bg-white border-bottom px-4 py-3">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1 class="h4 mb-0">@yield('page_title', 'Dashboard')</h1>
        </div>
        <div class="text-muted">
            {{ auth()->user()->name }}
        </div>
    </div>
</header>
