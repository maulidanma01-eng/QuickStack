<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="QuickStack — Sistem Inventory Digital untuk UMKM Tanah Laut">
    <title>@yield('title', 'Dashboard') — QuickStack</title>

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
            --qs-sidebar-bg: #0f172a;
            --qs-sidebar-w:  260px;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        /* ── SIDEBAR ─────────────────────────────── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--qs-sidebar-w);
            height: 100vh;
            background: var(--qs-sidebar-bg);
            overflow-y: auto;
            z-index: 1040;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand .logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--qs-green), #22c55e);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: #fff;
        }
        .sidebar-brand .brand-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
        }
        .sidebar-brand .brand-sub {
            font-size: .65rem;
            color: #94a3b8;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .sidebar-section {
            padding: .75rem 1.25rem .25rem;
            font-size: .65rem;
            font-weight: 600;
            color: #64748b;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .nav-item-qs { margin: 1px .75rem; }
        .nav-link-qs {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .6rem .9rem;
            border-radius: 8px;
            color: #94a3b8;
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: all .15s;
        }
        .nav-link-qs:hover {
            background: rgba(255,255,255,.07);
            color: #fff;
        }
        .nav-link-qs.active {
            background: linear-gradient(135deg, var(--qs-green), #22c55e);
            color: #fff;
            box-shadow: 0 4px 14px rgba(22,163,74,.35);
        }
        .nav-link-qs i { font-size: 1.05rem; width: 20px; text-align: center; }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.08);
            margin-top: auto;
        }

        /* ── TOPBAR ──────────────────────────────── */
        #topbar {
            position: fixed;
            top: 0;
            left: var(--qs-sidebar-w);
            right: 0;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 1030;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
        }

        /* ── MAIN CONTENT ────────────────────────── */
        #main {
            margin-left: var(--qs-sidebar-w);
            padding-top: 64px;
            min-height: 100vh;
        }
        .main-content { padding: 1.75rem; }

        /* ── CARDS ───────────────────────────────── */
        .card-qs {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
        }
        .stat-card {
            border-radius: 14px;
            border: none;
            color: #fff;
            padding: 1.4rem 1.5rem;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            right: -20px; top: -20px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,.12);
        }
        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: .9;
        }
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }
        .stat-card .stat-label {
            font-size: .8rem;
            opacity: .85;
            font-weight: 500;
        }

        /* ── BADGES ──────────────────────────────── */
        .badge-aman    { background: #dcfce7; color: #15803d; }
        .badge-menipis { background: #fef9c3; color: #a16207; }
        .badge-habis   { background: #fee2e2; color: #b91c1c; }

        /* ── TABLES ──────────────────────────────── */
        .table-qs thead th {
            background: #f8fafc;
            color: #64748b;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            border-bottom: 2px solid #e2e8f0;
            padding: .85rem 1rem;
        }
        .table-qs tbody td {
            padding: .85rem 1rem;
            vertical-align: middle;
            font-size: .875rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .table-qs tbody tr:hover { background: #f8fafc; }

        /* ── BUTTONS ─────────────────────────────── */
        .btn-qs-primary {
            background: linear-gradient(135deg, var(--qs-green), #22c55e);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: .5rem 1.25rem;
            border-radius: 8px;
            transition: all .2s;
        }
        .btn-qs-primary:hover {
            opacity: .9;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(22,163,74,.3);
            color: #fff;
        }

        /* ── PAGE HEADER ─────────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .page-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .page-subtitle {
            font-size: .8rem;
            color: #94a3b8;
            margin: 0;
        }

        /* ── ALERT ───────────────────────────────── */
        .alert-qs {
            border: none;
            border-radius: 10px;
            font-size: .875rem;
        }

        /* ── RESPONSIVE ──────────────────────────── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #topbar { left: 0; }
            #main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- ═══════════════════════════════════════ SIDEBAR ══════════════════════════════════════ -->
<nav id="sidebar">
    <!-- Brand -->
    <div class="sidebar-brand d-flex align-items-center gap-2">
        <div class="logo-icon"><i class="bi bi-boxes"></i></div>
        <div>
            <div class="brand-name">QuickStack</div>
            <div class="brand-sub">UMKM Tanah Laut</div>
        </div>
    </div>

    <!-- Nav -->
    <div class="py-2">
        <div class="sidebar-section">Menu Utama</div>

        <div class="nav-item-qs">
            <a href="{{ route('dashboard') }}"
               class="nav-link-qs {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </div>
        
        <div class="nav-item-qs">
            <a href="{{ route('catalog') }}"
               class="nav-link-qs">
                <i class="bi bi-shop"></i> Katalog Produk
            </a>
        </div>

        <div class="sidebar-section mt-2">Inventori</div>

        <div class="nav-item-qs">
            <a href="{{ route('products.index') }}"
               class="nav-link-qs {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Barang
            </a>
        </div>
        <div class="nav-item-qs">
            <a href="{{ route('categories.index') }}"
               class="nav-link-qs {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Kategori
            </a>
        </div>

        <div class="sidebar-section mt-2">Transaksi</div>

        <div class="nav-item-qs">
            <a href="{{ route('stock_ins.index') }}"
               class="nav-link-qs {{ request()->routeIs('stock_ins.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-down-circle"></i> Stok Masuk
            </a>
        </div>
        <div class="nav-item-qs">
            <a href="{{ route('stock_outs.index') }}"
               class="nav-link-qs {{ request()->routeIs('stock_outs.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-up-circle"></i> Stok Keluar
            </a>
        </div>
        <div class="nav-item-qs">
            <a href="{{ route('transactions.index') }}"
               class="nav-link-qs {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Riwayat
            </a>
        </div>

        <div class="sidebar-section mt-2">Analitik</div>

        <div class="nav-item-qs">
            <a href="{{ route('reports.index') }}"
               class="nav-link-qs {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i> Laporan
            </a>
        </div>
    </div>

    <!-- Sidebar footer -->
    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2">
            <div style="width:34px;height:34px;background:linear-gradient(135deg,#16a34a,#22c55e);
                        border-radius:50%;display:flex;align-items:center;justify-content:center;
                        color:#fff;font-weight:700;font-size:.9rem;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-size:.82rem;color:#e2e8f0;font-weight:600;">
                    {{ auth()->user()->name }}
                </div>
                <div style="font-size:.7rem;color:#64748b;">Administrator</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-sm w-100" style="
                background:rgba(239,68,68,.15);color:#fca5a5;
                border:1px solid rgba(239,68,68,.2);border-radius:7px;
                font-size:.8rem;">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
        </form>
    </div>
</nav>

<!-- ═══════════════════════════════════════ TOPBAR ═══════════════════════════════════════ -->
<div id="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm d-md-none" id="sidebarToggle">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div>
            <h1 class="mb-0" style="font-size:1rem;font-weight:700;color:#1e293b;">
                @yield('topbar-title', 'Dashboard')
            </h1>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <span style="font-size:.8rem;color:#94a3b8;">
            <i class="bi bi-calendar3 me-1"></i>
            {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </span>
        <div class="d-flex align-items-center gap-2">
            <div style="width:30px;height:30px;background:linear-gradient(135deg,#16a34a,#22c55e);
                        border-radius:50%;display:flex;align-items:center;justify-content:center;
                        color:#fff;font-weight:700;font-size:.8rem;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span style="font-size:.85rem;font-weight:600;">{{ auth()->user()->name }}</span>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════ MAIN ════════════════════════════════════════ -->
<div id="main">
    <div class="main-content">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-qs alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="bi bi-check-circle-fill text-success"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-qs alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });
    // Auto-dismiss alerts after 4 seconds
    document.querySelectorAll('.alert').forEach(a => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(a);
            bsAlert.close();
        }, 4000);
    });
</script>
@stack('scripts')
</body>
</html>
