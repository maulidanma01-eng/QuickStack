<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — QuickStack</title>
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
            padding: 2rem 1rem;
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
            max-width: 480px;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 50px rgba(0,0,0,.5);
        }
        .logo-circle {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 24px rgba(22,163,74,.4);
        }
        .brand-title { color: #fff; font-size: 1.5rem; font-weight: 700; text-align: center; }
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
        .invalid-feedback { color: #f87171; font-size: 0.8rem; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="logo-circle"><i class="bi bi-person-plus-fill"></i></div>
    <h1 class="brand-title">Daftar QuickStack</h1>
    <p class="brand-sub mb-4">Buat akun untuk mengelola stok UMKM Anda</p>

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" id="name" name="name"
                       class="form-control border-start-0 @error('name') is-invalid @enderror"
                       placeholder="Pemilik Warung"
                       value="{{ old('name') }}" required autofocus>
            </div>
            @error('name')<div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" id="email" name="email"
                       class="form-control border-start-0 @error('email') is-invalid @enderror"
                       placeholder="email@anda.com"
                       value="{{ old('email') }}" required>
            </div>
            @error('email')<div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" id="password" name="password"
                       class="form-control border-start-0 @error('password') is-invalid @enderror"
                       placeholder="Minimal 8 karakter" required>
            </div>
            @error('password')<div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control border-start-0"
                       placeholder="Ulangi password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-login w-100 mb-3">
            Daftar Akun
        </button>

        <div class="text-center" style="font-size: .85rem; color: #cbd5e1;">
            Sudah punya akun? 
            <a href="{{ route('login') }}" style="color: #4ade80; text-decoration: none; font-weight: 600;">Login di sini</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
