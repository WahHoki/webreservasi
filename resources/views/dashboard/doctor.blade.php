<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap');

        /* ── BASE ── */
        .dash-root {
            font-family: 'DM Sans', sans-serif;
            background: #f0f4ff;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(16,185,129,0.08) 0%, transparent 60%);
            padding: 1.75rem;
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
            color: rgba(199,210,254,0.9);
            font-size: 0.975rem;
            font-weight: 300;
            max-width: 480px;
            line-height: 1.6;
            position: relative;
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
        .hero-badge-date  { font-family: 'Clash Display', sans-serif; font-size: 0.9rem; color: #fff; font-weight: 600; margin-top: 2px; }
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
        .hero-cta:hover { background: rgba(255,255,255,0.25); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.2); }

        /* ── STAT STRIP ── */
        .stat-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
        .stat-icon-yellow { background: linear-gradient(135deg, #fef9c3, #fde68a); }
        .stat-icon-purple { background: linear-gradient(135deg, #ede9fe, #ddd6fe); }

        .stat-val { font-family: 'Clash Display', sans-serif; font-size: 1.5rem; font-weight: 700; color: #1e1b4b; line-height: 1; }
        .stat-lbl { font-size: 0.75rem; color: #6b7280; margin-top: 3px; }

        /* ── MAIN GRID ── */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        /* ── PANEL ── */
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
            font-weight: 700;
            color: #1e1b4b;
        }
        .panel-body { padding: 1.25rem 1.6rem 1.6rem; }

        /* ── PATIENT LIST ── */
        .patient-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            transition: background 0.18s;
            margin-bottom: 0.4rem;
        }
        .patient-item:last-child { margin-bottom: 0; }
        .patient-item:hover { background: #f8f9ff; }

        .patient-num {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: #fff;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Clash Display', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .patient-name { font-weight: 600; font-size: 0.9rem; color: #1e1b4b; }
        .patient-meta { font-size: 0.75rem; color: #6b7280; margin-top: 1px; }

        .patient-status {
            margin-left: auto;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.25rem 0.7rem;
            border-radius: 50px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .patient-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .status-pending  { background: #fef9c3; color: #854d0e; }
        .status-pending::before  { background: #eab308; }
        .status-done     { background: #dcfce7; color: #166534; }
        .status-done::before     { background: #22c55e; }
        .status-progress { background: #dbeafe; color: #1e40af; }
        .status-progress::before { background: #3b82f6; }

        .patient-empty {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; padding: 2.5rem 1rem; gap: 0.75rem;
        }
        .patient-empty-icon {
            width: 60px; height: 60px;
            background: #f5f3ff;
            border: 1.5px dashed #c7d2fe;
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── INFO PANEL ── */
        .info-item {
            display: flex; gap: 0.85rem;
            padding: 0.9rem 1rem;
            border-radius: 14px;
            transition: background 0.2s;
            margin-bottom: 0.4rem;
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

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .stat-strip { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .main-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .dash-root { padding: 1rem; }
            .hero-badge { display: none; }
            .hero-greeting { font-size: 1.5rem; }
            .stat-strip { grid-template-columns: repeat(2, 1fr); }
        }
    </style>

    <div class="dash-root">

        {{-- ── HERO ── --}}
        <div class="hero-card anim-1">
            <div class="hero-orb hero-orb-1"></div>
            <div class="hero-orb hero-orb-2"></div>

            <div class="hero-badge hidden sm:block">
                <div class="hero-badge-label">Hari ini</div>
                <div class="hero-badge-date">{{ now()->translatedFormat('d M Y') }}</div>
            </div>

            <div class="hero-greeting">Selamat Bertugas, {{ auth()->user()->name }}! 👨‍⚕️</div>
            <p class="hero-subtitle">Berikut ringkasan aktivitas praktik Anda hari ini. Semoga pelayanan berjalan lancar.</p>

            <a href="#" class="hero-cta">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Lihat Daftar Pasien
            </a>
        </div>

        {{-- ── STAT STRIP ── --}}
        <div class="stat-strip anim-2">
            <div class="stat-card">
                <div class="stat-icon stat-icon-blue">
                    <svg width="22" height="22" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-val">{{ $todayPatients ?? 0 }}</div>
                    <div class="stat-lbl">Pasien Hari Ini</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-yellow">
                    <svg width="22" height="22" fill="none" stroke="#d97706" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-val">{{ $waitingCount ?? 0 }}</div>
                    <div class="stat-lbl">Menunggu</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-green">
                    <svg width="22" height="22" fill="none" stroke="#10b981" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-val">{{ $doneCount ?? 0 }}</div>
                    <div class="stat-lbl">Selesai Diperiksa</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-purple">
                    <svg width="22" height="22" fill="none" stroke="#8b5cf6" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-val">{{ $scheduleCount ?? 0 }}</div>
                    <div class="stat-lbl">Jadwal Aktif</div>
                </div>
            </div>
        </div>

        {{-- ── MAIN GRID ── --}}
        <div class="main-grid">

            {{-- Antrean Pasien --}}
            <div class="panel anim-3">
                <div class="panel-header">
                    <svg width="18" height="18" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Antrean Pasien Hari Ini
                </div>
                <div class="panel-body">
                    @if(isset($todayReservations) && $todayReservations->count())
                        @foreach($todayReservations as $res)
                            <div class="patient-item">
                                <div class="patient-num">{{ str_pad($res->queue_number, 2, '0', STR_PAD_LEFT) }}</div>
                                <div style="flex:1; min-width:0;">
                                    <div class="patient-name">{{ $res->patient->user->name }}</div>
                                    <div class="patient-meta">
                                        <svg style="display:inline;vertical-align:-1px;margin-right:2px" width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
                                        {{ \Carbon\Carbon::parse($res->schedule->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($res->schedule->end_time)->format('H:i') }} WIB
                                    </div>
                                </div>
                                <span class="patient-status
                                    @if($res->status === 'completed') status-done
                                    @elseif($res->status === 'in_progress') status-progress
                                    @else status-pending @endif">
                                    @if($res->status === 'completed') Selesai
                                    @elseif($res->status === 'in_progress') Berlangsung
                                    @else Menunggu @endif
                                </span>
                            </div>
                        @endforeach
                    @else
                        <div class="patient-empty">
                            <div class="patient-empty-icon">
                                <svg width="28" height="28" fill="none" stroke="#c7d2fe" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p style="font-size:.875rem; color:#9ca3af; text-align:center;">
                                Belum ada pasien antrean untuk hari ini.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Panduan --}}
            <div class="panel anim-4">
                <div class="panel-header">
                    <svg width="18" height="18" fill="none" stroke="#10b981" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Panduan & Informasi
                </div>
                <div class="panel-body" style="padding-top:1rem;">

                    <div class="info-item">
                        <div class="info-dot">
                            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div class="info-text">
                            Daftar pasien <strong>diperbarui otomatis</strong> sesuai reservasi yang masuk untuk jadwal praktik Anda.
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-dot">
                            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="info-text">
                            Pastikan nomor antrean pasien telah <strong>diverifikasi</strong> oleh petugas sebelum pemeriksaan dimulai.
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-dot">
                            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="info-text">
                            Gunakan menu <strong>Jadwal</strong> untuk mengatur ketersediaan praktik Anda.
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-dot">
                            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div class="info-text">
                            Hubungi admin jika ada kendala teknis atau perubahan mendadak pada jadwal.
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>