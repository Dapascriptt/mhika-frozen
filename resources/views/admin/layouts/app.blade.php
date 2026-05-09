<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Mhika Frozen Food</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
</head>

<body class="admin-body">
    <div class="container-fluid admin-shell">
        <div class="row min-vh-100 g-0">
            @include('admin.partials.sidebar')

            <div class="col-lg-10 ms-sm-auto px-0 admin-main">
                @include('admin.partials.navbar')

                <main class="admin-content">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
