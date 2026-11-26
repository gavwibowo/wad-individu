<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donatur | MR. BUAS</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>
    <nav class="navbar donors-navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('donors.index') }}" class="brand-logo">
                MR. BUAS <span class="donors-logo-tag">Donatur</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('donors.index') }}" class="active" aria-current="page">Kelola Donatur</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section>
            <h1>Data Donatur</h1>
            <p>Kelola seluruh data donatur yang terdaftar pada platform crowdfunding MR. BUAS.</p>
        </section>

        @if (session('success'))
            <div role="status" class="card" style="margin-top:18px; border-left:4px solid #249e56;">
                {{ session('success') }}
            </div>
        @endif

        <div style="margin-top: 18px;">
            <a href="{{ route('donors.create') }}" class="btn-primary">+ Tambah Donatur</a>
        </div>

        <section class="card" style="margin-top: 18px;">
            <form action="{{ route('donors.index') }}" method="GET" class="form-group">
                <label for="search">Cari Donatur</label>
                <input
                    type="search"
                    name="search"
                    id="search"
                    class="form-control"
                    placeholder="Cari nama, email, atau nomor kontak..."
                    maxlength="100"
                    value="{{ $search }}"
                >
                <div style="margin-top: 12px; display: flex; align-items: center; gap: 10px;">
                    <button type="submit" class="btn-primary">Cari</button>
                    <a href="{{ route('donors.index') }}" class="btn-outline">Reset</a>
                </div>
            </form>
        </section>

        <section style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Donatur</th>
                        <th>Email</th>
                        <th>Nomor Kontak</th>
                        <th>Status Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donors as $donor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $donor->name }}</td>
                            <td>{{ $donor->email }}</td>
                            <td>{{ $donor->phone }}</td>
                            <td>{{ $donor->is_anonymous ? 'Anonim' : 'Publik' }}</td>
                            <td>
                                <a href="{{ route('donors.edit', $donor) }}" class="btn-outline">Edit</a>
                                <form action="{{ route('donors.destroy', $donor) }}" method="POST"
                                      style="display:inline; margin-left:8px;"
                                      onsubmit="return confirm('Yakin ingin menghapus data donatur ini? Data yang dihapus tidak dapat dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-outline"
                                            style="color:#b42318; border-color:#b42318; cursor:pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada data donatur yang cocok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
