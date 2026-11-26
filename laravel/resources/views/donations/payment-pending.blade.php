
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Donasi | MR. BUAS</title>

    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>

<body>

    <main class="container">

        <section class="card">

            <h1>Data Donatur Berhasil Divalidasi!</h1>

            <p>
                Terima kasih telah memilih campaign:
            </p>

            <h2>{{ $draft['campaign_title'] }}</h2>

            <hr>

            <h3>Informasi Donatur</h3>

            <p>
                Nama:
                {{ $draft['donor']['is_anonymous'] ? 'Orang Baik' : $draft['donor']['name'] }}
            </p>

            <p>
                Email:
                {{ $draft['donor']['email'] }}
            </p>

            <p>
                Nomor Kontak:
                {{ $draft['donor']['phone'] }}
            </p>

            <hr>

            <p>
                Data identitas saat ini tersimpan sementara
                dalam session Laravel.
            </p>

            <p>
                Modul Payment masih dalam tahap integrasi.
                Belum ada transaksi atau pembayaran yang dibuat.
            </p>

            <a href="{{ route('campaigns.index') }}" class="btn-primary">
                Kembali ke Campaign
            </a>

        </section>

    </main>

</body>
</html>
