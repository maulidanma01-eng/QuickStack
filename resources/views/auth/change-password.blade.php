<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Password — QuickStack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1a2e1a 50%, #0f2d0f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Inter, sans-serif;
            padding: 2rem 1rem;
        }

        .card-reset {
            width: 100%;
            max-width: 430px;
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

        .btn-main {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border: none;
            color: white;
            font-weight: 700;
            border-radius: 10px;
            padding: .8rem;
            transition: all .2s;
        }

        .btn-main:hover {
            opacity: .9;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22,163,74,.35);
        }
    </style>
</head>

<body>
<div class="card-reset">
    <h3 class="text-white fw-bold text-center mb-2">Ubah Password</h3>
    <p class="text-center mb-4" style="color:#94a3b8;font-size:.9rem;">
        Buat password baru untuk akun<br>
        {{ $email }}.
    </p>

    @if ($errors->any())
        <div class="alert border-0 rounded-3" style="background:rgba(239,68,68,.15);color:#fca5a5;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('password.change.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>

            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-lock"></i>
                </span>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control border-start-0 border-end-0"
                       placeholder="Minimal 8 karakter"
                       required>

                <button type="button"
                        class="input-group-text toggle-password"
                        data-target="password"
                        style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-left:none;color:#94a3b8;cursor:pointer;">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>

            <div class="input-group">
                <span class="input-group-text" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-right:none;color:#64748b;">
                    <i class="bi bi-lock-fill"></i>
                </span>

                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control border-start-0"
                       placeholder="Ulangi password baru"
                       required>
            </div>
        </div>

        <button type="submit" class="btn btn-main w-100">
            Simpan Password Baru
        </button>
    </form>
</div>

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