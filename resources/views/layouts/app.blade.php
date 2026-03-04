<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Reservasi RS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ── SIDEBAR ── */
            .sidebar-admin {
                width: 250px;
                flex-shrink: 0;
                background: linear-gradient(180deg, #1e1b4b 0%, #2e2a6e 60%, #312e81 100%);
                min-height: 100vh;
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
                display: flex;
                flex-direction: column;
                box-shadow: 4px 0 24px rgba(30,27,75,0.18);
            }

            /* scrollbar */
            .sidebar-admin::-webkit-scrollbar { width: 4px; }
            .sidebar-admin::-webkit-scrollbar-track { background: transparent; }
            .sidebar-admin::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }

            /* ── BRAND ── */
            .sidebar-brand {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                padding: 1.4rem 1.4rem 1.2rem;
                border-bottom: 1px solid rgba(255,255,255,0.07);
                text-decoration: none;
            }
            .brand-icon {
                width: 36px; height: 36px;
                background: linear-gradient(135deg, #4338ca, #6366f1);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                box-shadow: 0 4px 12px rgba(99,102,241,0.4);
                flex-shrink: 0;
            }
            .brand-text {
                font-family: 'Clash Display', sans-serif;
                font-size: 1.05rem;
                font-weight: 700;
                color: #fff;
                letter-spacing: 0.01em;
            }
            .brand-text span { color: #a5b4fc; }

            /* ── SECTION LABEL ── */
            .sidebar-section {
                padding: 1.1rem 1.4rem 0.4rem;
                font-size: 0.62rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: #6366f1;
            }

            /* ── NAV LINK ── */
            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.7rem 1.4rem;
                color: rgba(203,213,225,0.8);
                font-family: 'DM Sans', sans-serif;
                font-size: 0.875rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.18s ease;
                border-left: 3px solid transparent;
                margin: 0 0.5rem;
                border-radius: 0 10px 10px 0;
            }
            .sidebar-link:hover {
                background: rgba(99,102,241,0.15);
                color: #fff;
                border-left-color: rgba(99,102,241,0.4);
            }
            .sidebar-link.active {
                background: rgba(99,102,241,0.22);
                color: #fff;
                border-left-color: #818cf8;
                font-weight: 600;
            }
            .sidebar-link .link-icon {
                width: 32px; height: 32px;
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                font-size: 0.95rem;
                background: rgba(255,255,255,0.05);
                transition: background 0.18s;
            }
            .sidebar-link:hover .link-icon,
            .sidebar-link.active .link-icon {
                background: rgba(99,102,241,0.3);
            }

            /* ── FOOTER ── */
            .sidebar-footer {
                margin-top: auto;
                padding: 1rem 0.5rem 1.25rem;
                border-top: 1px solid rgba(255,255,255,0.07);
            }
            .sidebar-logout {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                width: 100%;
                padding: 0.7rem 1.4rem;
                background: transparent;
                border: none;
                border-radius: 10px;
                color: rgba(252,165,165,0.8);
                font-family: 'DM Sans', sans-serif;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                text-align: left;
                transition: all 0.18s ease;
            }
            .sidebar-logout:hover {
                background: rgba(239,68,68,0.12);
                color: #fca5a5;
            }
            .sidebar-logout .link-icon {
                width: 32px; height: 32px;
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
                background: rgba(255,255,255,0.05);
                font-size: 0.95rem;
                transition: background 0.18s;
            }
            .sidebar-logout:hover .link-icon { background: rgba(239,68,68,0.2); }

            /* ── USER INFO ── */
            .sidebar-user {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                padding: 0.75rem 1.4rem 0.5rem;
            }
            .user-avatar {
                width: 32px; height: 32px;
                border-radius: 50%;
                background: linear-gradient(135deg, #4338ca, #6366f1);
                display: flex; align-items: center; justify-content: center;
                font-size: 0.75rem;
                font-weight: 700;
                color: #fff;
                flex-shrink: 0;
            }
            .user-name {
                font-size: 0.78rem;
                color: rgba(255,255,255,0.7);
                font-weight: 500;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 150px;
            }

            /* ── MAIN CONTENT HEADER ── */
            .main-header {
                background: #fff;
                border-bottom: 1px solid #e8eaf6;
                padding: 1rem 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 1px 4px rgba(99,102,241,0.06);
            }
            .main-header h2 {
                font-family: 'Clash Display', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: #1e1b4b;
            }

            /* ── MAIN AREA ── */
            .main-area {
                background: #f0f4ff;
                background-image:
                    radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.09) 0%, transparent 60%),
                    radial-gradient(ellipse 60% 40% at 80% 110%, rgba(16,185,129,0.06) 0%, transparent 60%);
                min-height: calc(100vh - 57px);
            }
        </style>
    </head>
    <body class="font-sans antialiased" style="background:#f0f4ff;">

        @if(auth()->check() && auth()->user()->role === 'admin')
            {{-- ── ADMIN LAYOUT WITH SIDEBAR ── --}}
            <div class="flex">

                <aside class="sidebar-admin">

                    {{-- Brand --}}
                    <a href="{{ route('dashboard') }}" class="sidebar-brand">
                        <div class="brand-icon">
                            <svg width="18" height="18" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="brand-text">Medi<span>Care</span></span>
                    </a>

                    {{-- Nav --}}
                    <nav class="flex-1 py-3">

                        <a href="{{ route('dashboard') }}"
                           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="link-icon">🏠</span>
                            Dashboard
                        </a>

                        <div class="sidebar-section">Master Data</div>

                        <a href="{{ route('polyclinics.index') }}"
                           class="sidebar-link {{ request()->routeIs('polyclinics.*') ? 'active' : '' }}">
                            <span class="link-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </span>
                            Data Poli
                        </a>

                        <a href="{{ route('doctors.index') }}"
                           class="sidebar-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                            <span class="link-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            Data Dokter
                        </a>

                        <a href="{{ route('schedules.index') }}"
                           class="sidebar-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                            <span class="link-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            Jadwal Praktik
                        </a>

                    </nav>

                    {{-- Footer --}}
                    <div class="sidebar-footer">
                        {{-- User info --}}
                        <div class="sidebar-user">
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </div>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sidebar-logout">
                                <span class="link-icon">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </span>
                                Logout
                            </button>
                        </form>
                    </div>

                </aside>

                {{-- Main Content --}}
                <div class="flex-1 flex flex-col min-w-0">
                    @isset($header)
                        <header class="main-header">
                            {{ $header }}
                        </header>
                    @endisset

                    <main class="main-area p-6">
                        {{ $slot }}
                    </main>
                </div>

            </div>

        @else
            {{-- ── STANDARD LAYOUT FOR DOCTOR & PATIENT ── --}}
            <div class="min-h-screen">
                @include('layouts.navigation')

                @isset($header)
                    <header class="bg-white shadow-sm border-b border-indigo-50">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        @endif

    </body>
</html>
