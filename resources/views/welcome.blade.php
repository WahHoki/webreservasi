<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare — Sistem Reservasi Klinik</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --indigo-dark:  #1e1b4b;
            --indigo-mid:   #312e81;
            --indigo-base:  #6366f1;
            --indigo-light: #c7d2fe;
            --green-soft:   #34d399;
            --surface:      #f0f4ff;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.13) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(16,185,129,0.08) 0%, transparent 60%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 2.5rem;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(99,102,241,0.1);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #4338ca, #6366f1);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(99,102,241,0.35);
        }
        .brand-name {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--indigo-dark);
        }
        .brand-name span { color: var(--indigo-base); }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-ghost {
            padding: 0.55rem 1.25rem;
            border-radius: 50px;
            border: 1.5px solid #e0e2f0;
            background: transparent;
            color: var(--indigo-dark);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-ghost:hover { border-color: var(--indigo-base); color: var(--indigo-base); background: #f5f3ff; }

        .btn-primary {
            padding: 0.55rem 1.4rem;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(99,102,241,0.35);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.45); }

        /* ── HERO ── */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 5rem 1.5rem 3rem;
            position: relative;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #ede9fe;
            color: #5b21b6;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.9rem;
            border-radius: 50px;
            margin-bottom: 1.5rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .hero-title {
            font-family: 'Clash Display', sans-serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: var(--indigo-dark);
            line-height: 1.15;
            max-width: 680px;
            margin-bottom: 1.25rem;
        }
        .hero-title .highlight {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            font-size: 1.05rem;
            color: #4b5563;
            font-weight: 300;
            max-width: 500px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 4rem;
        }

        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2rem;
            border-radius: 50px;
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(99,102,241,0.4);
        }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(99,102,241,0.5); }

        .btn-hero-ghost {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2rem;
            border-radius: 50px;
            border: 1.5px solid #c7d2fe;
            background: #fff;
            color: var(--indigo-dark);
            font-size: 0.95rem;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .btn-hero-ghost:hover { border-color: var(--indigo-base); color: var(--indigo-base); transform: translateY(-3px); box-shadow: 0 6px 20px rgba(99,102,241,0.12); }

        /* ── FEATURE CARDS ── */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            max-width: 860px;
            width: 100%;
            margin: 0 auto;
        }

        .feature-card {
            background: #fff;
            border: 1px solid #e8eaf6;
            border-radius: 20px;
            padding: 1.5rem;
            text-align: left;
            box-shadow: 0 2px 12px rgba(99,102,241,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 10px 32px rgba(99,102,241,0.14); }

        .feature-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1rem;
        }
        .fi-blue   { background: linear-gradient(135deg, #dde1ff, #c7d2fe); }
        .fi-green  { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
        .fi-purple { background: linear-gradient(135deg, #ede9fe, #ddd6fe); }

        .feature-title {
            font-family: 'Clash Display', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--indigo-dark);
            margin-bottom: 0.4rem;
        }
        .feature-desc {
            font-size: 0.82rem;
            color: #6b7280;
            line-height: 1.6;
        }

        /* ── HERO CARD (bottom) ── */
        .cta-banner {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 80%, #6366f1 100%);
            padding: 2.5rem 3rem;
            margin: 3rem auto 0;
            max-width: 860px;
            width: calc(100% - 3rem);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            box-shadow: 0 20px 60px rgba(99,102,241,0.3);
        }
        .cta-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .cta-orb {
            position: absolute; border-radius: 50%;
            filter: blur(60px); opacity: 0.25; pointer-events: none;
        }
        .cta-orb-1 { width: 220px; height: 220px; background: #818cf8; top: -60px; right: -40px; }
        .cta-orb-2 { width: 140px; height: 140px; background: #34d399; bottom: -40px; right: 160px; }

        .cta-text { position: relative; }
        .cta-title {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.3rem;
        }
        .cta-sub { font-size: 0.875rem; color: rgba(199,210,254,0.85); font-weight: 300; }

        .cta-actions {
            display: flex; gap: 0.75rem; flex-shrink: 0; position: relative; flex-wrap: wrap;
        }

        .btn-cta-white {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.5rem;
            background: #fff;
            color: var(--indigo-dark);
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: all 0.22s ease;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        }
        .btn-cta-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.2); }

        .btn-cta-ghost {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.7rem 1.5rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            color: #fff;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: all 0.22s ease;
        }
        .btn-cta-ghost:hover { background: rgba(255,255,255,0.22); transform: translateY(-2px); }

        /* ── FOOTER ── */
        .footer {
            text-align: center;
            padding: 2rem 1.5rem;
            font-size: 0.8rem;
            color: #9ca3af;
            margin-top: 3rem;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .a1 { animation: fadeSlideUp 0.5s ease both; }
        .a2 { animation: fadeSlideUp 0.5s ease 0.1s both; }
        .a3 { animation: fadeSlideUp 0.5s ease 0.18s both; }
        .a4 { animation: fadeSlideUp 0.5s ease 0.26s both; }
        .a5 { animation: fadeSlideUp 0.5s ease 0.34s both; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .navbar { padding: 1rem 1.25rem; }
            .features { grid-template-columns: 1fr; max-width: 400px; }
            .cta-banner { flex-direction: column; text-align: center; padding: 2rem 1.5rem; }
            .cta-actions { justify-content: center; }
            .hero { padding: 3rem 1.25rem 2rem; }
        }
        @media (max-width: 480px) {
            .hero-actions { flex-direction: column; align-items: center; }
            .navbar-actions .btn-ghost { display: none; }
        }
    </style>
</head>
<body>

    {{-- ── NAVBAR ── --}}
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <div class="brand-icon">
                <svg width="20" height="20" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <span class="brand-name">Medi<span>Care</span></span>
        </a>
        <div class="navbar-actions">
            <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
            <a href="{{ route('register') }}" class="btn-primary">Daftar Sekarang</a>
        </div>
    </nav>

    {{-- ── HERO ── --}}
    <section class="hero">
        <div class="hero-tag a1">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Sistem Reservasi Klinik Online
        </div>

        <h1 class="hero-title a2">
            Jadwalkan Kunjungan <span class="highlight">Dokter Anda</span> dengan Mudah
        </h1>

        <p class="hero-sub a3">
            Pesan antrean, pilih dokter, dan kelola riwayat kunjungan Anda — kapan saja, di mana saja, tanpa antri panjang.
        </p>

        <div class="hero-actions a4">
            <a href="{{ route('register') }}" class="btn-hero-primary">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Daftar Gratis
            </a>
            <a href="{{ route('login') }}" class="btn-hero-ghost">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk ke Akun
            </a>
        </div>

        {{-- Feature Cards --}}
        <div class="features a5">
            <div class="feature-card">
                <div class="feature-icon fi-blue">
                    <svg width="22" height="22" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="feature-title">Reservasi Mudah</div>
                <div class="feature-desc">Pilih poliklinik, dokter, dan jadwal hanya dalam beberapa langkah cepat.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-green">
                    <svg width="22" height="22" fill="none" stroke="#10b981" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <div class="feature-title">Nomor Antrean Digital</div>
                <div class="feature-desc">Dapatkan nomor antrean langsung di aplikasi, tanpa perlu hadir lebih awal.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-purple">
                    <svg width="22" height="22" fill="none" stroke="#8b5cf6" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="feature-title">Riwayat Kunjungan</div>
                <div class="feature-desc">Pantau semua riwayat janji temu dan status pemeriksaan Anda dengan mudah.</div>
            </div>
        </div>

        {{-- CTA Banner --}}
        <div class="cta-banner">
            <div class="cta-orb cta-orb-1"></div>
            <div class="cta-orb cta-orb-2"></div>
            <div class="cta-text">
                <div class="cta-title">Siap memulai? Daftar sekarang gratis.</div>
                <div class="cta-sub">Bergabunglah dan nikmati kemudahan reservasi klinik digital.</div>
            </div>
            <div class="cta-actions">
                <a href="{{ route('register') }}" class="btn-cta-white">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn-cta-ghost">
                    Masuk
                </a>
            </div>
        </div>
    </section>

    <footer class="footer">
        &copy; {{ date('Y') }} MediCare. Sistem Reservasi Klinik Online.
    </footer>

</body>
</html>
