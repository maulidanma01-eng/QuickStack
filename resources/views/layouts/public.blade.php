<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Katalog Produk QuickStack - UMKM Tanah Laut">
    <title>@yield('title', 'Katalog Produk') — QuickStack</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --qs-green:      #16a34a;
            --qs-green-dark: #15803d;
            --qs-green-light:#bbf7d0;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f8fafc;
            color: #1e293b;
            padding-top: 76px; /* Space for fixed navbar */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOP NAV ─────────────────────────────── */
        .navbar-qs {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0.8rem 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
        }
        
        .navbar-brand-qs {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        
        .logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--qs-green), #22c55e);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: #fff;
            box-shadow: 0 4px 10px rgba(22,163,74,0.3);
        }
        
        .brand-text {
            line-height: 1.1;
        }
        .brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .brand-sub {
            font-size: 0.7rem;
            color: #64748b;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin: 0;
        }

        .btn-login-outline {
            color: var(--qs-green-dark);
            border: 1px solid rgba(22,163,74,0.3);
            background: rgba(22,163,74,0.05);
            font-weight: 600;
            padding: 0.4rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        .btn-login-outline:hover {
            background: var(--qs-green);
            color: #fff;
            border-color: var(--qs-green);
            transform: translateY(-1px);
        }

        /* ── FOOTER ──────────────────────────────── */
        .footer-qs {
            background: #fff;
            border-top: 1px solid #e2e8f0;
            padding: 2rem 0;
            margin-top: auto;
        }

    </style>
    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-qs fixed-top">
    <div class="container">
        <a class="navbar-brand-qs" href="{{ route('catalog') }}">
            <div class="logo-icon"><i class="bi bi-boxes"></i></div>
            <div class="brand-text">
                <p class="brand-name">QuickStack</p>
                <p class="brand-sub">UMKM Tanah Laut</p>
            </div>
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <i class="bi bi-list fs-1 text-dark"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-2 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-500 {{ request()->routeIs('catalog') ? 'text-success fw-600' : 'text-secondary' }}" href="{{ route('catalog') }}">Katalog Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-500 {{ request()->routeIs('help') ? 'text-success fw-600' : 'text-secondary' }}" href="{{ route('help') }}">Bantuan</a>
                </li>
                <li class="nav-item ms-lg-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-login-outline w-100">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login-outline w-100">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login Kasir
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow-1">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer-qs text-center mt-5">
    <div class="container">
        <p class="mb-1 text-muted fw-500" style="font-size: 0.9rem;">
            &copy; {{ date('Y') }} QuickStack — Sistem Inventory Digital UMKM Tanah Laut
        </p>
        <p class="mb-2 text-muted" style="font-size: 0.8rem;">
            Dibuat untuk memudahkan transaksi dan stok.
        </p>
        <div class="d-flex justify-content-center align-items-center gap-3">
            <a href="{{ route('help') }}" class="text-success text-decoration-none" style="font-size: 0.85rem; font-weight: 500;">
                <i class="bi bi-question-circle me-1"></i> Pusat Bantuan
            </a>
            <span class="text-muted" style="font-size: 0.8rem;">|</span>
            <a href="mailto:quickstackumkm@gmail.com" class="text-success text-decoration-none" style="font-size: 0.85rem; font-weight: 500;">
                <i class="bi bi-envelope me-1"></i> quickstackumkm@gmail.com
            </a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
