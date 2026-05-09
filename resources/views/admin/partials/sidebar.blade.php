<aside class="col-lg-2 admin-sidebar text-white p-0">
    <div class="admin-sidebar-inner position-sticky top-0 min-vh-100 p-3">
        <a class="admin-brand text-white text-decoration-none mb-4" href="{{ route('admin.dashboard') }}">
            <span class="admin-brand-mark">M</span>
            <span>
                <strong>Mhika</strong>
                <small>Admin Panel</small>
            </span>
        </a>

        <span class="admin-nav-label">Menu</span>
        <nav class="admin-nav nav nav-pills flex-column gap-1">
            <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fa fa-box me-2"></i>Produk
            </a>
            <a class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="fa fa-tags me-2"></i>Kategori
            </a>
        </nav>

        <span class="admin-nav-label mt-4">Aksi</span>
        <nav class="admin-nav nav nav-pills flex-column gap-1">
            <a class="nav-link text-white" href="{{ route('home') }}" target="_blank">
                <i class="fa fa-external-link-alt me-2"></i>Lihat Website
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-link nav-link text-white px-3 text-start w-100" type="submit">
                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </nav>
    </div>
</aside>
