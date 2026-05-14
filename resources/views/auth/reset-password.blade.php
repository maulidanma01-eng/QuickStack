<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password — QuickStack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1a2e1a 50%, #0f2d0f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Inter, sans-serif;
        }

        .card-reset {
            width: 100%;
            max-width: 450px;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 20px;
            padding: 2.3rem;
            box-shadow: 0 25px 50px rgba(0,0,0,.45);
        }

        .form-label {
            color: #cbd5e1;
            font-weight: 600;
            font-size: .9rem;
        }

        .form-control {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            color: white;
            border-radius: 10px;
            padding: .75rem 1rem;
        }

        .form-control:focus {
            background: rgba(255,255,255,.09);
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,.2);
            color: white;
        }

        .btn-main {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border: none;
            color: white;
            font-weight: 700;
            border-radius: 10px;
            padding: .8rem;
        }
    </style>
</head>
<body>
<div class="card-reset">
    <h3 class="text-white fw-bold text-center mb-2">Reset Password</h3>
    <p class="text-center mb-4" style="color:#94a3b8;font-size:.9rem;">
        Masukkan password baru untuk akun kamu.
    </p>

    @if ($errors->any())
        <div class="alert border-0 rounded-3" style="background:rgba(239,68,68,.15);color:#fca5a5;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $email) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Minimal 8 karakter"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Ulangi password baru"
                   required>
        </div>

        <button type="submit" class="btn btn-main w-100">
            Simpan Password Baru
        </button>
    </form>
</div>
</body>
</html>