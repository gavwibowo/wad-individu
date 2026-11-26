<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi | MR. BUAS</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="/" class="brand-logo">MR. BUAS</a>
            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="{{ route('campaigns.index') }}">Campaign</a></li>
                <li><a href="{{ route('donors.public.index') }}">Donatur</a></li>
                <li><a href="/partners">Mitra Penyalur</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">

        <section>
            <h1>Form Donasi</h1>
            <p>Lengkapi data diri sebelum melanjutkan ke pembayaran.</p>
        </section>

        <!-- CAMPAIGN TERPILIH -->
        <section class="card">
            <p>Anda akan berdonasi untuk:</p>
            <h2>{{ $campaign->title }}</h2>
            <p><strong>Kategori:</strong> {{ $campaign->category }}</p>
            <p><strong>Dana Terkumpul:</strong> Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
            <p><strong>Target:</strong> Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
            <p><strong>Progress:</strong> {{ number_format($progress, 1) }}%</p>
        </section>

        <br>

        <!-- FORM IDENTITAS DONATUR -->
        <section class="card">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donations.store', $campaign->id) }}" method="POST">
                @csrf

                <!-- NOMINAL DONASI -->
                <div class="form-group">
                    <label for="amount">Nominal Donasi</label>
                    <input type="number" id="amount" name="amount"
                        class="form-control"
                        placeholder="Masukkan nominal donasi"
                        value="{{ old('amount') }}" min="1" required>
                </div>

                <!-- NAMA -->
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('name') }}" required>
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        class="form-control"
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}" required>
                </div>

                <!-- TELEPON -->
                <div class="form-group">
                    <label for="phone">Nomor Kontak</label>
                    <input type="tel" id="phone" name="phone"
                        class="form-control"
                        placeholder="Contoh: 081234567890"
                        value="{{ old('phone') }}" required>
                </div>

                <!-- ANONIMITAS -->
                <div class="form-group">
                    <label for="is_anonymous">Pengaturan Nama</label>
                    <select id="is_anonymous" name="is_anonymous" class="form-control" required>
                        <option value="" disabled {{ old('is_anonymous') === null ? 'selected' : '' }}>
                            -- Pilih Status --
                        </option>
                        <option value="0" {{ old('is_anonymous') === '0' ? 'selected' : '' }}>
                            Tampilkan Nama Saya
                        </option>
                        <option value="1" {{ old('is_anonymous') === '1' ? 'selected' : '' }}>
                            Donasi Sebagai Anonim
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <p>
                        Jika memilih anonim, nama Anda akan ditampilkan sebagai
                        <strong>"Orang Baik"</strong> pada halaman publik.
                    </p>
                </div>

                <!-- TOMBOL -->
                <button type="submit" class="btn-primary">
                    Lanjut ke Pembayaran
                </button>

                <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn-outline">
                    Kembali
                </a>

            </form>
        </section>

    </main>

</body>
</html>
