<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap');

        .dash-root {
            font-family: 'DM Sans', sans-serif;
            background: #f0f4ff;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(16,185,129,0.08) 0%, transparent 60%);
            padding: 1.75rem;
        }

        .dash-title-font {
            font-family: 'Clash Display', 'DM Sans', sans-serif;
        }

        /* ── HERO CARD ── */
        .hero-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 80%, #6366f1 100%);
            padding: 2.5rem 2.5rem 2rem;
            margin-bottom: 1.75rem;
            box-shadow: 0 20px 60px rgba(99,102,241,0.35), 0 4px 16px rgba(0,0,0,0.1);
        }

        .hero-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.3;
            pointer-events: none;
        }
        .hero-orb-1 { width: 280px; height: 280px; background: #818cf8; top: -80px; right: -60px; }
        .hero-orb-2 { width: 180px; height: 180px; background: #34d399; bottom: -60px; right: 120px; }

        .hero-greeting {
            font-family: 'Clash Display', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 0.4rem;
            position: relative;
        }

        .hero-subtitle {
            color: rgba(199, 210, 254, 0.9);
            font-size: 0.975rem;
            font-weight: 300;
            max-width: 440px;
            line-height: 1.6;
            position: relative;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.75rem;
            padding: 0.75rem 1.5rem;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 50px;
            color: #fff;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.25s ease;
            position: relative;
        }
        .hero-cta:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        .hero-badge {
            position: absolute;
            top: 1.75rem;
            right: 1.75rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            text-align: center;
            backdrop-filter: blur(8px);
        }
        .hero-badge-label { font-size: 0.65rem; color: #c7d2fe; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 500; }
        .hero-badge-date { font-family: 'Clash Display', sans-serif; font-size: 0.9rem; color: #fff; font-weight: 600; margin-top: 2px; }

        /* ── STAT STRIP ── */
        .stat-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 1.25rem 1.4rem;
            border: 1px solid #e8eaf6;
            box-shadow: 0 2px 12px rgba(99,102,241,0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(99,102,241,0.14); }

        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon-blue   { background: linear-gradient(135deg, #dde1ff, #c7d2fe); }
        .stat-icon-green  { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
        .stat-icon-purple { background: linear-gradient(135deg, #ede9fe, #ddd6fe); }

        .stat-val { font-family: 'Clash Display', sans-serif; font-size: 1.5rem; font-weight: 700; color: #1e1b4b; line-height: 1; }
        .stat-lbl { font-size: 0.75rem; color: #6b7280; margin-top: 3px; }

        /* ── MAIN GRID ── */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 900px) {
            .main-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .stat-strip { grid-template-columns: 1fr; }
            .hero-badge { display: none; }
            .hero-greeting { font-size: 1.5rem; }
            .dash-root { padding: 1rem; }
        }

        /* ── PANEL BASE ── */
        .panel {
            background: #fff;
            border-radius: 22px;
            border: 1px solid #e8eaf6;
            box-shadow: 0 2px 12px rgba(99,102,241,0.06);
            overflow: hidden;
        }

        .panel-header {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 1.4rem 1.6rem 0;
            font-family: 'Clash Display', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #1e1b4b;
        }

        .panel-body { padding: 1.25rem 1.6rem 1.6rem; }

        /* ── APPOINTMENT CARD ── */
        .appt-card {
            background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
            border: 1px solid #ddd6fe;
            border-radius: 18px;
            padding: 1.4rem;
            position: relative;
            overflow: hidden;
        }
        .appt-card::after {
            content: '';
            position: absolute;
            width: 120px; height: 120px;
            background: radial-gradient(circle, rgba(99,102,241,0.15), transparent 70%);
            bottom: -30px; right: -30px;
            border-radius: 50%;
        }

        .appt-meta-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #7c3aed;
            margin-bottom: 3px;
        }

        .appt-date-text {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e1b4b;
        }

        .appt-time-text {
            font-size: 0.85rem;
            color: #4b5563;
            margin-top: 2px;
        }

        .queue-badge {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border-radius: 14px;
            padding: 0.5rem 1rem;
            text-align: center;
            box-shadow: 0 4px 14px rgba(99,102,241,0.4);
        }
        .queue-lbl { font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.8; }
        .queue-num { font-family: 'Clash Display', sans-serif; font-size: 2rem; font-weight: 700; line-height: 1.1; }

        .appt-divider { height: 1px; background: rgba(99,102,241,0.15); margin: 1rem 0; }

        .appt-doctor-label { font-size: 0.72rem; color: #7c3aed; font-weight: 500; margin-bottom: 2px; }
        .appt-doctor-name { font-family: 'Clash Display', sans-serif; font-size: 1rem; font-weight: 600; color: #1e1b4b; }
        .appt-poli { font-size: 0.8rem; color: #6366f1; margin-top: 2px; font-weight: 500; }

        .appt-empty {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 2.5rem 1rem; gap: 0.75rem;
            color: #9ca3af;
        }
        .appt-empty-icon {
            width: 64px; height: 64px;
            background: #f3f4f6;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── INFO PANEL ── */
        .info-item {
            display: flex;
            gap: 0.85rem;
            padding: 1rem 1.1rem;
            border-radius: 14px;
            transition: background 0.2s;
            margin-bottom: 0.5rem;
        }
        .info-item:last-child { margin-bottom: 0; }
        .info-item:hover { background: #f8f7ff; }

        .info-dot {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 2px;
        }

        .info-text { font-size: 0.875rem; color: #374151; line-height: 1.6; }
        .info-text strong { color: #1e1b4b; font-weight: 600; }

        /* ── ANIMATIONS ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-1 { animation: fadeSlideUp 0.5s ease both; }
        .anim-2 { animation: fadeSlideUp 0.5s ease 0.1s both; }
        .anim-3 { animation: fadeSlideUp 0.5s ease 0.2s both; }
        .anim-4 { animation: fadeSlideUp 0.5s ease 0.3s both; }
    </style>

    <div class="dash-root">
        <div>

            {{-- ── HERO ── --}}
            <div class="hero-card anim-1">
                <div class="hero-orb hero-orb-1"></div>
                <div class="hero-orb hero-orb-2"></div>

                <div class="hero-badge hidden sm:block">
                    <div class="hero-badge-label">Hari ini</div>
                    <div class="hero-badge-date">{{ now()->translatedFormat('d M Y') }}</div>
                </div>

                <div class="hero-greeting">Halo, {{ auth()->user()->name }}! 👋</div>
                <p class="hero-subtitle">Semoga hari Anda menyenangkan dan selalu sehat. Ada yang bisa kami bantu hari ini?</p>

                <a href="{{ route('reservation.index') }}" class="hero-cta">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Buat Janji Temu Baru
                </a>
            </div>

            {{-- ── STAT STRIP ── --}}
            <div class="stat-strip anim-2">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-blue">
                        <svg width="22" height="22" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <div class="stat-val">{{ auth()->user()->patient?->reservations?->count() ?? 0 }}</div>
                        <div class="stat-lbl">Total Reservasi</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon stat-icon-green">
                        <svg width="22" height="22" fill="none" stroke="#10b981" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="stat-val">{{ auth()->user()->patient?->reservations?->where('status','completed')->count() ?? 0 }}</div>
                        <div class="stat-lbl">Kunjungan Selesai</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon stat-icon-purple">
                        <svg width="22" height="22" fill="none" stroke="#8b5cf6" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="stat-val">{{ auth()->user()->patient?->reservations?->where('status','pending')->count() ?? 0 }}</div>
                        <div class="stat-lbl">Menunggu</div>
                    </div>
                </div>
            </div>

            {{-- ── MAIN GRID ── --}}
            <div class="main-grid">

                {{-- Appointment Panel --}}
                <div class="panel anim-3">
                    <div class="panel-header">
                        <svg width="18" height="18" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Janji Temu Terdekat
                    </div>
                    <div class="panel-body">
                        @if($nextReservation)
                            <div class="appt-card">
                                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem;">
                                    <div>
                                        <div class="appt-meta-label">Tanggal &amp; Waktu</div>
                                        <div class="appt-date-text">{{ \Carbon\Carbon::parse($nextReservation->reservation_date)->translatedFormat('l, d F Y') }}</div>
                                        <div class="appt-time-text">
                                            <svg style="display:inline;margin-right:4px;vertical-align:-2px" width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
                                            {{ \Carbon\Carbon::parse($nextReservation->schedule->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($nextReservation->schedule->end_time)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                    <div class="queue-badge" style="flex-shrink:0">
                                        <div class="queue-lbl">Antrean</div>
                                        <div class="queue-num">{{ str_pad($nextReservation->queue_number, 3, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>

                                <div class="appt-divider"></div>

                                <div>
                                    <div class="appt-doctor-label">Dokter Tujuan</div>
                                    <div class="appt-doctor-name">{{ $nextReservation->schedule->doctor->user->name }}</div>
                                    <div class="appt-poli">
                                        <svg style="display:inline;margin-right:3px;vertical-align:-2px" width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        {{ $nextReservation->schedule->doctor->polyclinic->name }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="appt-empty">
                                <div class="appt-empty-icon">
                                    <svg width="30" height="30" fill="none" stroke="#d1d5db" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div style="font-size:.875rem; color:#9ca3af; text-align:center;">
                                    Belum ada janji temu yang akan datang.<br>
                                    <a href="{{ route('reservation.index') }}" style="color:#6366f1; font-weight:500;">Buat sekarang →</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Info Panel --}}
                <div class="panel anim-4">
                    <div class="panel-header">
                        <svg width="18" height="18" fill="none" stroke="#10b981" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Panduan Kunjungan
                    </div>
                    <div class="panel-body" style="padding-top:1rem;">

                        <div class="info-item">
                            <div class="info-dot">
                                <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="info-text">
                                Harap datang <strong>15 menit</strong> sebelum jadwal praktik dimulai untuk proses verifikasi.
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-dot">
                                <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M12 18h.01M8 21h8a2 2 0 002-2v-7l-4-4H8a2 2 0 00-2 2v9a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="info-text">
                                Tunjukkan <strong>nomor antrean digital</strong> Anda kepada petugas di meja pendaftaran.
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-dot">
                                <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <div class="info-text">
                                Gunakan menu <strong>Reservasi</strong> untuk melihat seluruh riwayat kunjungan Anda.
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-dot">
                                <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div class="info-text">
                                Hubungi resepsionis jika ada kendala atau pertanyaan sebelum kunjungan.
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
