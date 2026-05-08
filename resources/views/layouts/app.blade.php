<!DOCTYPE html>
<html lang="id">

<head>
    @php
        $seoTitle = trim($__env->yieldContent('title', 'Mhika Frozen Food Balikpapan | Supplier Frozen Food Murah'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'Mhika Frozen Food Balikpapan menyediakan nugget, sosis, kentang, beef burger, ayam siap makan, dan aneka frozen food berkualitas dengan harga terjangkau.'));
        $seoKeywords = trim($__env->yieldContent('meta_keywords', 'frozen food balikpapan, frozen food murah balikpapan, supplier frozen food balikpapan, jual frozen food balikpapan, nugget balikpapan, sosis balikpapan, mhika frozen food'));
        $seoImage = trim($__env->yieldContent('og_image', asset('assets/img/frozen-food.png')));
        $canonicalUrl = trim($__env->yieldContent('canonical', url()->current()));
    @endphp
    <meta charset="utf-8">
    <title>{{ $seoTitle }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="description" content="{{ $seoDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Mhika Frozen Food Balikpapan">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Store",
            "name": "Mhika Frozen Food Balikpapan",
            "description": "Supplier frozen food murah dan berkualitas di Balikpapan.",
            "image": "{{ asset('assets/img/frozen-food.png') }}",
            "url": "{{ route('home') }}",
            "telephone": "+62 812 3456 7890",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Balikpapan",
                "addressRegion": "Kalimantan Timur",
                "addressCountry": "ID"
            },
            "areaServed": "Balikpapan"
        }
    </script>
    @stack('styles')
</head>

<body class="site-body">
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('partials.scripts')
    @stack('scripts')
</body>

</html>
