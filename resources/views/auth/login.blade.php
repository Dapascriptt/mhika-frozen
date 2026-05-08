<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Mhika Frozen Food</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    <main class="min-vh-100 d-flex align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="bg-white border rounded shadow-sm p-4 p-md-5">
                        <div class="mb-4 text-center">
                            <h1 class="h3 fw-bold text-primary mb-1">Mhika Frozen</h1>
                            <p class="text-muted mb-0">Login Admin</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">Email atau password tidak sesuai.</div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" id="remember" type="checkbox" name="remember" value="1">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                        </form>
                        <div class="text-center mt-4">
                            <a class="text-body" href="{{ route('home') }}">Kembali ke website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
