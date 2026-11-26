
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Donasi | MR. BUAS</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="/" class="brand-logo">MR. BUAS</a>
            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="{{ route('campaigns.index') }}">Campaign</a></li>
                <li><a href="{{ route('donors.public.index') }}">Donatur</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">

        <section>
            <h1>Pembayaran Donasi</h1>
            <p>Periksa data donasi dan pilih metode pembayaran.</p>
        </section>

        <!-- DATA DONASI -->
        <section class="card">
            <h2>Ringkasan Donasi</h2>

            <p><strong>Campaign:</strong> {{ $draft['campaign_title'] }}</p>

            <p><strong>Nama Donatur:</strong>
                {{ $draft['donor']['is_anonymous'] ? 'Orang Baik' : $draft['donor']['name'] }}
            </p>

            <p><strong>Email:</strong> {{ $draft['donor']['email'] }}</p>

            <p><strong>Nomor Kontak:</strong> {{ $draft['donor']['phone'] }}</p>

            <p><strong>Nominal Donasi:</strong>
                Rp {{ number_format($draft['amount'], 0, ',', '.') }}
            </p>
        </section>

        <br>

        <!-- PILIH METODE PEMBAYARAN -->
        <section class="card">
            <h2>Pilih Metode Pembayaran</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            @if($paymentMethods->isEmpty())

                <p>Belum ada metode pembayaran yang tersedia.</p>

            @else

                <form action="{{ route('payments.confirm') }}" method="POST">
                    @csrf

                    @foreach($paymentMethods as $method)
                        <label style="display:block; padding:15px; margin-bottom:12px; border:1px solid #ccc; border-radius:8px; cursor:pointer;">

                            <input type="radio"
                                name="payment_method_id"
                                value="{{ $method->id }}"
                                {{ old('payment_method_id') == $method->id ? 'checked' : '' }}
                                required>

                            <strong>{{ $method->bank_name }}</strong>

                            <br>

                            {{ $method->type == 'bank' ? 'Transfer Bank' : 'E-Wallet' }}

                            <br>

                            Nomor Rekening / Akun:
                            {{ $method->account_number }}

                            <br>

                            Atas Nama:
                            {{ $method->owner_name }}

                        </label>
                    @endforeach

                    <button type="submit" class="btn-primary">
                        Konfirmasi Donasi
                    </button>

                </form>

            @endif

            <br>

            <a href="{{ route('campaigns.index') }}" class="btn-outline">
                Kembali ke Campaign
            </a>

        </section>

    </main>

</body>
</html>
