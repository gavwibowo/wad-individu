<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MR. BUAS menghubungkan program bantuan dengan orang-orang baik yang ingin berbagi. Temukan campaign dan mulai berdonasi.">
    <meta name="theme-color" content="#071a40">

    <title>MR. BUAS — Kebaikan Nggak Harus Kecil</title>

    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assests/css/home.css') }}">
</head>
<body class="mr-home">
    <header class="hero-home" id="beranda">
        <div class="hero-home-overlay" aria-hidden="true"></div>

        <nav class="home-navbar" aria-label="Navigasi utama">
            <div class="home-container home-nav-wrapper">
                <a href="{{ route('home') }}" class="home-brand-logo" aria-label="MR. BUAS, Beranda">
                    MR.<span aria-hidden="true">⚡</span><br>
                    BUAS
                </a>

                <button
                    class="home-menu-toggle"
                    type="button"
                    aria-expanded="false"
                    aria-controls="home-navigation"
                    data-menu-toggle
                >
                    <span class="home-menu-toggle-lines" aria-hidden="true"></span>
                    <span class="home-menu-toggle-label">Menu</span>
                </button>

                <ul class="home-nav-menu" id="home-navigation">
                    <li><a href="{{ route('home') }}" class="active" aria-current="page">Beranda</a></li>
                    <li><a href="{{ route('campaigns.index') }}">Campaign</a></li>
                    <li><a href="{{ route('donors.public.index') }}">Donatur</a></li>
                    <li><a href="#tentang-kami">Tentang Kami</a></li>
                </ul>
        <div class="home-nav-actions">
	            @guest
		            <a href="/login" class="home-login-button">Masuk</a>
	            @else
		            <a href="{{ route('admin.campaigns.index') }}" class="home-login-button">Dashboard</a>
		            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
			    @csrf
			        <button type="submit" class="home-login-button" style="border: none; cursor: pointer; background: #ef4444; color: white;">Logout</button>
		    </form>
                @endguest
                </div>
            </div>
        </nav>

        <div class="home-container hero-home-content">
            <div class="hero-home-text">
                <div class="hero-home-badge">
                    Sedikit dari kita,
                    <strong>besar untuk mereka.</strong>
                </div>

                <h1>
                    KEBAIKAN
                    <span>NGGAK HARUS KECIL.</span>
                </h1>

                <p class="hero-home-description">
                    Bersama MR. BUAS, bantu mereka yang membutuhkan dan lihat
                    dampak nyata dari setiap donasimu.
                </p>

                <div class="hero-home-buttons">
                    <a href="{{ route('campaigns.index') }}" class="hero-primary-button">
                        <span aria-hidden="true">♥</span>
                        Mulai Berdonasi
                    </a>
                    <a href="#tentang-kami" class="hero-secondary-button">
                        Kenali MR. BUAS
                    </a>
                </div>
            </div>
        </div>

        <section class="home-statistics" aria-label="Statistik MR. BUAS">
            <a href="{{ route('campaigns.index') }}" class="home-stat-item">
                <div class="home-stat-icon" aria-hidden="true">▣</div>
                <div class="home-stat-copy">
                    <h2>{{ number_format($campaignCount, 0, ',', '.') }}</h2>
                    <h3>Campaign Tersedia</h3>
                    <p>Program bantuan yang dapat kamu dukung.</p>
                </div>
            </a>

            <div class="home-stat-item">
                <div class="home-stat-icon yellow" aria-hidden="true">●</div>
                <div class="home-stat-copy">
                    <h2>Rp {{ number_format($fundsRaised, 0, ',', '.') }}</h2>
                    <h3>Dana Terkumpul</h3>
                    <p>Total dana yang tercatat pada campaign.</p>
                </div>
            </div>

            <a href="{{ route('donors.public.index') }}" class="home-stat-item">
                <div class="home-stat-icon" aria-hidden="true">♥</div>
                <div class="home-stat-copy">
                    <h2>{{ number_format($donorCount, 0, ',', '.') }}</h2>
                    <h3>Donatur Terdaftar</h3>
                    <p>Orang baik yang telah ikut berkontribusi.</p>
                </div>
            </a>
        </section>
    </header>

    <main>
        <section class="home-about" id="tentang-kami">
            <div class="home-container home-about-grid">
                <div class="home-about-intro">
                    <p class="home-section-eyebrow">TENTANG MR. BUAS</p>
                    <h2>Kebaikan tumbuh ketika kita bergerak bersama.</h2>
                    <p class="home-about-description">
                        MR. BUAS adalah platform crowdfunding yang menghubungkan
                        program bantuan dengan orang-orang yang ingin berbagi.
                        Temukan campaign, pahami kebutuhannya, lalu ambil bagian
                        sesuai kemampuanmu.
                    </p>
                    <a href="{{ route('campaigns.index') }}" class="home-about-link">
                        Jelajahi Campaign <span aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="home-about-cards">
                    <article class="home-about-card">
                        <span class="home-about-card-number">01</span>
                        <div>
                            <h3>Temukan Campaign</h3>
                            <p>Jelajahi berbagai program bantuan yang sedang berjalan.</p>
                        </div>
                    </article>

                    <article class="home-about-card">
                        <span class="home-about-card-number">02</span>
                        <div>
                            <h3>Kenali Kebutuhannya</h3>
                            <p>Baca informasi, target, dan perkembangan dana setiap campaign.</p>
                        </div>
                    </article>

                    <article class="home-about-card">
                        <span class="home-about-card-number">03</span>
                        <div>
                            <h3>Ambil Bagian</h3>
                            <p>Pilih campaign dan lanjutkan proses donasi dengan mudah.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer class="home-footer">
        <div class="home-container home-footer-inner">
            <a href="{{ route('home') }}" class="home-footer-brand">MR. <span>⚡</span> BUAS</a>
            <p>Berbagi kebaikan, menghadirkan harapan.</p>
            <small>&copy; {{ date('Y') }} MR. BUAS. Semua hak dilindungi.</small>
        </div>
    </footer>

    <script>
        (() => {
            const toggle = document.querySelector('[data-menu-toggle]');
            const menu = document.getElementById('home-navigation');

            if (!toggle || !menu) return;

            const closeMenu = () => {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.remove('is-open');
            };

            toggle.addEventListener('click', () => {
                const isOpen = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', String(!isOpen));
                menu.classList.toggle('is-open', !isOpen);
            });

            menu.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', closeMenu);
            });
        })();
    </script>
</body>
</html>
