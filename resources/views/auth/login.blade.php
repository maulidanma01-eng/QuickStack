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
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1a2e1a 50%, #0f2d0f 100%);
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 20% 50%, rgba(22,163,74,.15) 0%, transparent 50%),
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
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; color: #fff;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 24px rgba(22,163,74,.4);
        }
        .brand-title { color: #fff; font-size: 1.6rem; font-weight: 700; text-align: center; }
        .brand-sub { color: #94a3b8; font-size: .8rem; text-align: center; }
        .form-label { color: #cbd5e1; font-size: .85rem; font-weight: 500; }
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
        .form-control::placeholder { color: #64748b; }
        .btn-login {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border: none; color: #fff;
            font-weight: 600; border-radius: 10px;
            padding: .75rem;
            font-size: 1rem;
            transition: all .2s;
        }
        .btn-login:hover {
            opacity: .9; color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22,163,74,.4);
        }
        .invalid-feedback { color: #f87171; }
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
    <div class="logo-circle"><i class="bi bi-boxes"></i></div>
    <h1 class="brand-title">QuickStack</h1>
    <p class="brand-sub mb-4">Sistem Inventory Digital UMKM Tanah Laut</p>

    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-3 mb-3" style="background:rgba(239,68,68,.15);color:#fca5a5;font-size:.85rem;">
            <i class="bi bi-exclamation-triangle me-1"></i>
            {{ $errors->first() }}
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
                <input type="email" id="email" name="email"
                       class="form-control border-start-0 @error('email') is-invalid @enderror"
                       placeholder="admin@quickstack.id"
                       value="{{ old('email') }}" required autofocus>
            </div>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" id="password" name="password"
                       class="form-control border-start-0"
                       placeholder="••••••••" required>
            </div>
        </div>
        <button type="submit" class="btn btn-login w-100 mb-4">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
        </button>
    </form>

    <!-- Demo credentials -->
    <div class="demo-badge mb-3">
        <i class="bi bi-info-circle me-1"></i>
        <strong>Demo:</strong> admin@quickstack.id / password
    </div>

    <div class="text-center" style="font-size: .85rem; color: #cbd5e1;">
        Belum punya akun? 
        <a href="{{ route('register') }}" style="color: #4ade80; text-decoration: none; font-weight: 600;">Daftar di sini</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
