<header class="admin-topbar">
    <div class="d-flex align-items-center justify-content-between gap-3">
        <div>
            <span class="admin-page-kicker">Mhika Frozen Food</span>
            <h1 class="h4 mb-0">@yield('page_title', 'Dashboard')</h1>
        </div>
        <div class="admin-user-pill">
            <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            <div>
                <strong>{{ auth()->user()->name }}</strong>
                <small>Administrator</small>
            </div>
        </div>
    </div>
</header>
