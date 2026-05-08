@extends('layouts.app')

@section('title', 'Contact Us | Mhika Frozen Food Balikpapan')
@section('meta_description', 'Hubungi Mhika Frozen Food Balikpapan untuk informasi produk, stok, dan pemesanan frozen food murah berkualitas.')
@section('meta_keywords', 'contact mhika frozen food, frozen food balikpapan, supplier frozen food balikpapan, jual frozen food balikpapan')

@section('content')
    <div class="container-fluid page-header modern-page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <span class="hero-eyebrow">Kontak & Lokasi</span>
            <h1 class="display-3 mb-3 animated slideInDown">Contact Mhika Frozen Food Balikpapan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-xxl py-6 modern-section">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <span class="section-kicker">Hubungi Tim</span>
                <h2 class="display-5 mb-3">Kontak dan Lokasi</h2>
                <p>Hubungi Mhika Frozen Food atau cek lokasi toko melalui peta berikut.</p>
            </div>
            <div class="row g-5 align-items-stretch contact-location-grid">
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="contact-info-panel bg-primary text-white d-flex flex-column justify-content-center h-100 p-5">
                        <h5 class="text-white">Telepon</h5>
                        <p class="mb-5"><i class="fa fa-phone-alt me-3"></i>+62 813-4780-1998</p>
                        <h5 class="text-white">Email</h5>
                        <p class="mb-5"><i class="fa fa-envelope me-3"></i>info@mhikafrozenfood.test</p>
                        <h5 class="text-white">Area</h5>
                        <p class="mb-5"><i class="fa fa-map-marker-alt me-3"></i>Balikpapan, Kalimantan Timur</p>
                        <h5 class="text-white">Social</h5>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-0" href="https://wa.me/6281347801998" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="map-panel h-100">
                        <iframe
                            title="Google Maps Mhika Frozen Food Balikpapan"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8971720896902!2d116.92571327350032!3d-1.2312158355653422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df145004690d105%3A0x4ed3798002825bb7!2sMhika%20Frozen!5e0!3m2!1sen!2sid!4v1778259419007!5m2!1sen!2sid"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
