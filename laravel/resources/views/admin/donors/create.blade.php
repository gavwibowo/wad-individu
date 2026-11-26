<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Donatur | MR. BUAS</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>
    <nav class="navbar donors-navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('donors.index') }}" class="brand-logo">
                MR. BUAS <span class="donors-logo-tag">Donatur</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('donors.index') }}" class="active">Kelola Donatur</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section>
            <h1>Tambah Donatur</h1>
            <p>Tambahkan data donatur baru ke sistem MR. BUAS.</p>
        </section>

        <section class="card" style="margin-top: 18px;">
            @if ($errors->any())
                <div role="alert" style="border:1px solid #e88; background:#fff2f2; padding:12px; margin-bottom:16px; border-radius:6px;">
                    <strong>Periksa kembali data berikut:</strong>
                    <ul style="margin:8px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donors.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name') }}" maxlength="150" required
                           placeholder="Masukkan nama lengkap donatur">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email') }}" maxlength="150" required
                           placeholder="contoh@email.com">
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Kontak</label>
                    <input type="tel" id="phone" name="phone" class="form-control"
                           value="{{ old('phone') }}" minlength="8" maxlength="30" required
                           placeholder="Contoh: 081234567890"
                           title="8–15 digit; boleh + di awal, spasi, tanda hubung, atau tanda kurung">
                </div>

                <div class="form-group">
                    <label for="is_anonymous">Pengaturan Nama Donatur</label>
                    <select id="is_anonymous" name="is_anonymous" class="form-control" required>
                        <option value="" disabled {{ old('is_anonymous') === null ? 'selected' : '' }}>-- Pilih Status --</option>
                        <option value="0" {{ old('is_anonymous') === '0' ? 'selected' : '' }}>Publik</option>
                        <option value="1" {{ old('is_anonymous') === '1' ? 'selected' : '' }}>Anonim</option>
                    </select>
                </div>

                <div class="form-group">
                    <p><strong>Catatan:</strong> Untuk donor anonim, nama asli tetap disimpan bagi admin,
                       namun pada halaman publik nantinya ditampilkan sebagai <strong>Orang Baik</strong>.</p>
                </div>

                <button type="submit" class="btn-primary">Simpan Donatur</button>
                <a href="{{ route('donors.index') }}" class="btn-outline">Batal</a>
            </form>
        </section>
    </main>
</body>
</html>
