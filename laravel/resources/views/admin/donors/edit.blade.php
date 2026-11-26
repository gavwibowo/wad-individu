<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Donatur | MR. BUAS</title>
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
            <h1>Edit Donatur</h1>
            <p>Perbarui data donatur MR. BUAS.</p>
        </section>

        <section class="card" style="margin-top:18px;">
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

            <form method="POST" action="{{ route('donors.update', $donor) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name', $donor->name) }}" maxlength="150" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email', $donor->email) }}" maxlength="150" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Kontak</label>
                    <input type="tel" id="phone" name="phone" class="form-control"
                           value="{{ old('phone', $donor->phone) }}" minlength="8" maxlength="30" required
                           title="8–15 digit; boleh + di awal, spasi, tanda hubung, atau tanda kurung">
                </div>

                <div class="form-group">
                    <label for="is_anonymous">Pengaturan Nama Donatur</label>
                    <select id="is_anonymous" name="is_anonymous" class="form-control" required>
                        <option value="0" @selected((string) old('is_anonymous', (int) $donor->is_anonymous) === '0')>Publik</option>
                        <option value="1" @selected((string) old('is_anonymous', (int) $donor->is_anonymous) === '1')>Anonim</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Simpan Perubahan</button>
                <a href="{{ route('donors.index') }}" class="btn-outline">Batal</a>
            </form>
        </section>
    </main>
</body>
</html>
