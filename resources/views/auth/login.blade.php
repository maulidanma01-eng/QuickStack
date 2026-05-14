<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — QuickStack</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1a2e1a 50%, #0f2d0f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(22,163,74,.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(34,197,94,.1) 0%, transparent 50%);
        }

        .login-card {
            background: rgba(255,255,255,.04);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 50px rgba(0,0,0,.5);
        }

        .logo-circle {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #fff;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 24px rgba(22,163,74,.4);
        }

        .brand-title {
            color: #fff;
            font-size: 1.6rem;
            font-weight: 700;
            text-align: center;
        }

        .brand-sub {
            color: #94a3b8;
            font-size: .8rem;
            text-align: center;
        }

        .form-label {
            color: #cbd5e1;
            font-size: .85rem;
            font-weight: 500;
        }

        .form-control {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 10px;
            color: #fff;
            padding: .65rem 1rem;
            font-size: .9rem;
        }

        .form-control:focus {
            background: rgba(255,255,255,.09);
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .input-group .form-control {
            border-radius: 0;
        }

        .input-group-text:first-child {
            border-radius: 10px 0 0 10px;
        }

        .toggle-password {
            border-radius: 0 10px 10px 0 !important;
            user-select: none;
        }

        .forgot-link {
            color: #4ade80;
            text-decoration: none;
            font-size: .85rem;
            font-weight: 600;
        }

        .forgot-link:hover {
            color: #86efac;
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: .75rem;
            font-size: 1rem;
            transition: all .2s;
        }

        .btn-login:hover {
            opacity: .9;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22,163,74,.4);
        }

        .btn-google {
            background: #ffffff;
            border: 1px solid #dadce0;
            color: #3c4043;
            font-weight: 600;
            border-radius: 12px;
            padding: .85rem 1rem;
            font-size: 1rem;
            text-decoration: none;
            transition: all .2s ease;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: .8rem;
        }

        .btn-google:hover {
            background: #ffffff;
            color: #202124;
            border-color: #c6cace;
            box-shadow: 0 3px 10px rgba(0,0,0,.12);
            transform: translateY(-1px);
        }

        .google-icon {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }

        .invalid-feedback {
            color: #f87171;
        }

        .demo-badge {
            background: rgba(22,163,74,.15);
            border: 1px solid rgba(22,163,74,.3);
            border-radius: 8px;
            padding: .6rem .9rem;
            font-size: .78rem;
            color: #86efac;
        }
    </style>
</head>

<body>
<div class="login-card">
    <div class="logo-circle">
        <i class="bi bi-boxes"></i>
    </div>

    <h1 class="brand-title">QuickStack</h1>
    <p class="brand-sub mb-4">Sistem Inventory Digital UMKM Tanah Laut</p>

    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-3 mb-3" style="background:rgba(239,68,68,.15);color:#fca5a5;font-size:.85rem;">
            <i class="bi bi-exclamation-triangle me-1"></i>
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert border-0 rounded-3 mb-3" style="background:rgba(22,163,74,.15);color:#86efac;font-size:.85rem;">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" id="loginForm">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-envelope"></i>
                </span>

                <input type="email"
                       id="email"
                       name="email"
                       class="form-control border-start-0 @error('email') is-invalid @enderror"
                       placeholder="admin@quickstack.id"
                       value="{{ old('email') }}"
                       required
                       autofocus>
            </div>
        </div>

        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-lock"></i>
                </span>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control border-start-0 border-end-0"
                       placeholder="••••••••"
                       required>

                <button type="button"
                        class="input-group-text toggle-password"
                        data-target="password"
                        style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-left:none;color:#94a3b8;cursor:pointer;">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4 text-end">
            <a href="{{ route('password.request') }}" class="forgot-link">
                Lupa password?
            </a>
        </div>

        <button type="submit" class="btn btn-login w-100 mb-3">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Masuk ke Dashboard
        </button>

        <a href="{{ route('google.login') }}" class="btn btn-google w-100 mb-4">
            <svg class="google-icon" viewBox="0 0 48 48" aria-hidden="true">
                <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303C33.654 32.657 29.252 36 24 36c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                <path fill="#FF3D00" d="M6.306 14.691l6.571 4.819C14.655 16.108 19.009 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4c-7.682 0-14.41 4.337-17.694 10.691z"/>
                <path fill="#4CAF50" d="M24 44c5.168 0 9.86-1.977 13.409-5.193l-6.19-5.238C29.143 35.091 26.715 36 24 36c-5.231 0-9.621-3.327-11.283-7.946l-6.522 5.025C9.438 39.556 16.227 44 24 44z"/>
                <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.084 5.57c.001-.001 6.19 5.238 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
            </svg>

            <span>Masuk dengan Google</span>
        </a>
    </form>

    <div class="demo-badge mb-3">
        <i class="bi bi-info-circle me-1"></i>
        <strong>Demo:</strong> admin@quickstack.id / password
    </div>

    <div class="text-center" style="font-size: .85rem; color: #cbd5e1;">
        Belum punya akun?
        <a href="{{ route('register') }}" style="color: #4ade80; text-decoration: none; font-weight: 600;">
            Daftar di sini
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.toggle-password').forEach(function(button) {
    button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
});
</script>
</body>
</html>