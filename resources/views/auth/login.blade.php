<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — MediCare</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: #f0f4ff;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.13) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(16,185,129,0.08) 0%, transparent 60%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* ── CARD ── */
        .login-card {
            width: 100%;
            max-width: 360px;
            background: #fff;
            border-radius: 24px;
            border: 1px solid #e8eaf6;
            box-shadow: 0 8px 40px rgba(99,102,241,0.12), 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
            animation: fadeSlideUp 0.5s ease both;
        }

        /* ── CARD HEADER ── */
        .card-header {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 80%, #6366f1 100%);
            padding: 1.5rem 1.75rem 1.35rem;
            text-align: center;
        }
        .card-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .header-orb {
            position: absolute; border-radius: 50%;
            filter: blur(50px); opacity: 0.25; pointer-events: none;
        }
        .orb-1 { width: 180px; height: 180px; background: #818cf8; top: -60px; right: -40px; }
        .orb-2 { width: 120px; height: 120px; background: #34d399; bottom: -40px; left: 20px; }

        .brand-logo {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 13px;
            backdrop-filter: blur(8px);
            margin-bottom: 0.65rem;
        }

        .card-title {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            position: relative;
            margin-bottom: 0.2rem;
        }
        .card-subtitle {
            font-size: 0.775rem;
            color: rgba(199,210,254,0.85);
            font-weight: 300;
            position: relative;
        }

        /* ── CARD BODY ── */
        .card-body { padding: 1.35rem 1.75rem 1.75rem; }

        /* ── SESSION STATUS ── */
        .session-status {
            background: #f0fdf4;
            border-left: 4px solid #22c55e;
            color: #166534;
            font-size: 0.775rem;
            padding: 0.65rem 0.9rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        /* ── FORM ── */
        .field { margin-bottom: 0.85rem; }

        .field-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #374151;
            margin-bottom: 0.35rem;
        }

        .field-input {
            width: 100%;
            border: 1.5px solid #e0e2f0;
            border-radius: 10px;
            padding: 0.6rem 0.9rem;
            font-size: 0.825rem;
            font-family: 'DM Sans', sans-serif;
            color: #1e1b4b;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .field-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .field-error {
            font-size: 0.7rem;
            color: #ef4444;
            margin-top: 0.3rem;
        }

        /* ── REMEMBER + FORGOT ── */
        .row-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.775rem;
            color: #4b5563;
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: #6366f1;
            border-radius: 4px;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.775rem;
            color: #6366f1;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: #4338ca; text-decoration: underline; }

        /* ── SUBMIT ── */
        .btn-submit {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Clash Display', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 4px 16px rgba(99,102,241,0.35);
            margin-bottom: 1rem;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(99,102,241,0.45); }

        /* ── REGISTER LINK ── */
        .register-row {
            text-align: center;
            font-size: 0.775rem;
            color: #6b7280;
            padding-top: 0.9rem;
            border-top: 1px solid #f0f1fa;
        }
        .register-row a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }
        .register-row a:hover { text-decoration: underline; }

        /* ── BACK LINK ── */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.775rem;
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover { color: #6366f1; }

        /* ── ANIMATION ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div>
        <div class="login-card">

            {{-- Header --}}
            <div class="card-header">
                <div class="header-orb orb-1"></div>
                <div class="header-orb orb-2"></div>

                <div class="brand-logo">
                    <svg width="24" height="24" fill="none" stroke="rgba(255,255,255,0.9)" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div class="card-title">Selamat Datang</div>
                <div class="card-subtitle">Masuk ke akun MediCare Anda</div>
            </div>

            {{-- Body --}}
            <div class="card-body">

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="session-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="field">
                        <label class="field-label" for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="field-input"
                            placeholder="nama@email.com"
                        />
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="field">
                        <label class="field-label" for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="field-input"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="row-options">
                        <label class="remember-label">
                            <input type="checkbox" name="remember" id="remember_me">
                            Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-submit">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk
                    </button>

                    {{-- Register --}}
                    @if (Route::has('register'))
                        <div class="register-row">
                            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                        </div>
                    @endif

                </form>
            </div>
        </div>

        <a href="{{ url('/') }}" class="back-link">← Kembali ke Beranda</a>
    </div>

</body>
</html>
