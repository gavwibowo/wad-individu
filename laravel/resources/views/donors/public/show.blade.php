<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Donatur | MR. BUAS</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>
    <nav class="navbar donors-navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('donors.public.index') }}" class="brand-logo">
                MR. BUAS <span class="donors-logo-tag">Donatur</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('donors.public.index') }}" class="active">Donatur Publik</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section>
            <h1>Detail Donatur</h1>
            <p>Informasi publik donatur MR. BUAS.</p>
        </section>

        <section class="card">
            <h2>{{ $donor->is_anonymous ? 'Orang Baik' : $donor->name }}</h2>

            <div class="form-group">
                <p><strong>Status Nama:</strong> {{ $donor->is_anonymous ? 'Anonim' : 'Publik' }}</p>
            </div>
            <div class="form-group">
                <p><strong>Bergabung Sejak:</strong> {{ $donor->created_at?->format('d-m-Y') ?? '-' }}</p>
            </div>

            @if ($donor->is_anonymous)
                <div class="form-group">
                    <p>Donatur memilih untuk menyembunyikan identitasnya dari halaman publik.</p>
                </div>
            @endif

            <a class="btn-outline" href="{{ route('donors.public.index') }}">Kembali ke Daftar Donatur</a>
        </section>
    </main>
</body>
</html>
