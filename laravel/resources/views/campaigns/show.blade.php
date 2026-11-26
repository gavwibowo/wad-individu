<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->title }} - MR. BUAS</title>
    <!-- CSS (Menggunakan folder 'assests' sesuai penyesuaian folder publikmu) -->
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assests/css/campaign_css.css') }}">
</head>
<body style="background-color: #f7f9fc;">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="{{ url('/') }}" class="home-brand-logo teks-gradasi-biru">
                MR.<span>⚡</span><br>BUAS
            </a>
            <ul class="cmp-nav-menu">
                <li><a href="{{ url('/') }}" class="cmp-nav-link">Beranda</a></li>
                <li><a href="{{ route('campaigns.index') }}" class="cmp-nav-link active">Campaign</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Detail -->
    <main class="container" style="padding: 40px 0;">
        @php
            $target = ($campaign->target_amount ?? 0) > 0 ? (int)$campaign->target_amount : 1;
            $current = (int)($campaign->current_amount ?? 0);
            $persen = round(($current / $target) * 100);
            if ($persen > 100) $persen = 100;
            
            // Menggunakan gambar dari DB atau gambar fallback
            $image = !empty($campaign->image) ? $campaign->image : 'devin-hp.jpeg';
        @endphp

        <!-- Breadcrumb -->
        <p style="color: #64748b; font-size: 0.9rem;">
            Campaign &gt; {{ $campaign->category ?? 'Umum' }} &gt; Detail
        </p>

        <!-- Judul Campaign -->
        <h1 style="color: #071a40; margin-top: 8px; font-weight: 900;">
            {{ $campaign->title }}
        </h1>

        <div class="cmp-detail-grid">
            <!-- Kolom Kiri: Banner Gambar & Deskripsi -->
            <div>
                <div class="cmp-banner-placeholder">
                    <img src="{{ asset('assests/images/' . $image) }}" 
                         alt="{{ $campaign->title }}" 
                         class="cmp-banner-img">
                </div>
                <div style="margin-top: 24px; line-height: 1.8; color: #334155;">
                    <h3 style="color: #071a40; margin-bottom: 8px;">Deskripsi Program</h3>
                    <p>{!! nl2br(e($campaign->description ?? 'Belum ada deskripsi.')) !!}</p>
                </div>
            </div>

            <!-- Kolom Kanan: Card Status Dana & Tombol Donasi -->
            <div>
                <div class="cmp-card" style="position: sticky; top: 100px;">
                    <p style="font-size: 0.85rem; color: #64748b;">Total Terkumpul</p>
                    <h2 style="font-size: 2.2rem; color: #071a40; font-weight: 800;">
                        Rp {{ number_format($current, 0, ',', '.') }}
                    </h2>
                    <p style="font-size: 0.85rem; color: #64748b;">
                        Target Dana: <strong>Rp {{ number_format($target, 0, ',', '.') }}</strong> ({{ $persen }}%)
                    </p>
                    <div class="cmp-progress-track" style="margin-top: 16px;">
                        <div class="cmp-progress-fill" style="width: {{ $persen }}%;"></div>
                    </div>
                    <a href="{{ route('donations.create', $campaign->id) }}"
                        class="btn btn-primary"
                        style="display:block; text-align:center; width:100%; margin-top:20px; font-size:1.1rem; padding:14px;">
                        Donasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>