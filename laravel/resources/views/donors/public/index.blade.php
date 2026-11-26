<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Donatur | MR. BUAS</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>
    <nav class="navbar donors-navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('donors.public.index') }}" class="brand-logo">
                MR. BUAS <span class="donors-logo-tag">Donatur</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('donors.public.index') }}" class="active" aria-current="page">Donatur Publik</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section>
            <h1>Daftar Donatur</h1>
            <p>Terima kasih kepada seluruh orang baik yang telah ikut membantu melalui MR. BUAS.</p>
        </section>

        <section style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Donatur</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donors as $donor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $donor->is_anonymous ? 'Orang Baik' : $donor->name }}</td>
                            <td>{{ $donor->is_anonymous ? 'Anonim' : 'Publik' }}</td>
                            <td>
                                <a class="btn-outline" href="{{ route('donors.public.show', $donor->id) }}">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada donatur.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <section>
            <p>Total: <strong>{{ $donors->count() }}</strong> donatur.</p>
        </section>
    </main>
</body>
</html>
