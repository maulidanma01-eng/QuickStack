@extends('layouts.app')

@section('title', 'Dashboard')
@section('topbar-title', 'Dashboard')

@push('styles')
<style>
    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .welcome-banner::before {
        content: '';
        position: absolute; right: -50px; top: -100px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(34,197,94,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .welcome-banner::after {
        content: '';
        position: absolute; left: 20%; bottom: -150px;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .welcome-text h1 {
        font-size: 1.8rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;
    }
    .welcome-text p {
        font-size: 1rem; color: #cbd5e1; margin-bottom: 0;
    }

    /* Enhanced Stat Cards */
    .stat-card-new {
        border-radius: 18px;
        padding: 1.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
    .stat-card-new:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    .stat-card-green  { background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%); }
    .stat-card-blue   { background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); }
    .stat-card-amber  { background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); }
    .stat-card-red    { background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%); }
    
    .stat-card-new .bg-icon {
        position: absolute;
        right: -10px; bottom: -20px;
        font-size: 6rem;
        opacity: 0.15;
        transform: rotate(-15deg);
        transition: all 0.4s ease;
    }
    .stat-card-new:hover .bg-icon {
        transform: rotate(0deg) scale(1.1);
        opacity: 0.25;
    }
    .stat-card-new .stat-value { font-size: 2.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 0.25rem; }
    .stat-card-new .stat-label { font-size: 0.9rem; font-weight: 600; opacity: 0.9; }

    /* Action Cards */
    .action-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        color: #1e293b;
        border: 1px solid #f1f5f9;
        transition: all 0.25s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .action-card:hover {
        background: #f8fafc;
        transform: translateY(-3px);
        border-color: #e2e8f0;
        box-shadow: 0 10px 20px rgba(0,0,0,0.04);
        color: #1e293b;
    }
    .action-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }
    
    .type-badge-in  { background:#dcfce7;color:#15803d;border-radius:8px;padding:4px 12px;font-size:.75rem;font-weight:600; }
    .type-badge-out { background:#fee2e2;color:#b91c1c;border-radius:8px;padding:4px 12px;font-size:.75rem;font-weight:600; }
    
    .card-qs-modern {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
</style>
@endpush

@section('content')

<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="welcome-text d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
        <div>
            <h1>Halo, {{ auth()->user()->name }}! 👋</h1>
            <p>Berikut adalah ringkasan inventori QuickStack Anda hari ini.</p>
        </div>
        <div class="d-none d-md-block text-end">
            <div style="background: rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 12px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                <i class="bi bi-calendar3 me-2 text-success"></i>
                <span class="text-white fw-500">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- ── STAT CARDS ───────────────────────────────────────────────── -->
<div class="row g-4 mb-5">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-new stat-card-green">
            <i class="bi bi-box-seam bg-icon"></i>
            <div class="position-relative" style="z-index: 1;">
                <div class="stat-value">{{ $totalProducts }}</div>
                <div class="stat-label mb-3">Total Jenis Produk</div>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-light bg-white bg-opacity-25 border-0 text-white w-100 text-start rounded-3" style="backdrop-filter: blur(5px);">
                    Lihat Katalog <i class="bi bi-arrow-right float-end mt-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-new stat-card-blue">
            <i class="bi bi-wallet2 bg-icon"></i>
            <div class="position-relative" style="z-index: 1;">
                <div class="stat-value" style="font-size: 1.8rem;">Rp {{ number_format($todaySales, 0, ',', '.') }}</div>
                <div class="stat-label mb-3">Penjualan Hari Ini</div>
                <div class="btn btn-sm btn-light bg-white bg-opacity-10 border-0 text-white w-100 text-start rounded-3" style="cursor:default;">
                    <i class="bi bi-info-circle me-1"></i> Omzet penjualan hari ini
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-new stat-card-amber">
            <i class="bi bi-exclamation-triangle bg-icon"></i>
            <div class="position-relative" style="z-index: 1;">
                <div class="stat-value">{{ $lowStock }}</div>
                <div class="stat-label mb-3">Produk Stok Menipis</div>
                <a href="{{ route('reports.index') }}" class="btn btn-sm btn-light bg-white bg-opacity-25 border-0 text-white w-100 text-start rounded-3" style="backdrop-filter: blur(5px);">
                    Cek Laporan <i class="bi bi-arrow-right float-end mt-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-new stat-card-red">
            <i class="bi bi-x-circle bg-icon"></i>
            <div class="position-relative" style="z-index: 1;">
                <div class="stat-value">{{ $outOfStock }}</div>
                <div class="stat-label mb-3">Produk Stok Habis</div>
                <a href="{{ route('stock_ins.create') }}" class="btn btn-sm btn-light bg-white bg-opacity-25 border-0 text-white w-100 text-start rounded-3" style="backdrop-filter: blur(5px);">
                    Restock Sekarang <i class="bi bi-arrow-right float-end mt-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ── QUICK ACTIONS ─────────────────────────────────────────── -->
<h5 class="fw-800 mb-3" style="color: #1e293b;">Aksi Cepat</h5>
<div class="row g-3 mb-5">
    <div class="col-md-4 col-lg-2">
        <a href="{{ route('products.create') }}" class="action-card">
            <div class="action-icon" style="background: #e0e7ff; color: #4f46e5;"><i class="bi bi-box-fill"></i></div>
            <div class="fw-600 lh-sm" style="font-size:0.9rem;">Tambah<br>Produk</div>
        </a>
    </div>
    <div class="col-md-4 col-lg-2">
        <a href="{{ route('categories.create') }}" class="action-card">
            <div class="action-icon" style="background: #f3e8ff; color: #9333ea;"><i class="bi bi-tags-fill"></i></div>
            <div class="fw-600 lh-sm" style="font-size:0.9rem;">Tambah<br>Kategori</div>
        </a>
    </div>
    <div class="col-md-4 col-lg-3">
        <a href="{{ route('stock_ins.create') }}" class="action-card" style="border: 1px solid #bbf7d0;">
            <div class="action-icon" style="background: #dcfce7; color: #16a34a;"><i class="bi bi-box-arrow-in-down"></i></div>
            <div class="fw-600 lh-sm" style="font-size:0.9rem;">Catat Barang<br><span class="text-success">Masuk (Restock)</span></div>
        </a>
    </div>
    <div class="col-md-4 col-lg-3">
        <a href="{{ route('stock_outs.create') }}" class="action-card" style="border: 1px solid #fecaca;">
            <div class="action-icon" style="background: #fee2e2; color: #dc2626;"><i class="bi bi-box-arrow-up"></i></div>
            <div class="fw-600 lh-sm" style="font-size:0.9rem;">Catat Barang<br><span class="text-danger">Keluar (Terjual)</span></div>
        </a>
    </div>
    <div class="col-md-4 col-lg-2">
        <a href="{{ route('reports.index') }}" class="action-card">
            <div class="action-icon" style="background: #ffedd5; color: #ea580c;"><i class="bi bi-bar-chart-fill"></i></div>
            <div class="fw-600 lh-sm" style="font-size:0.9rem;">Lihat<br>Laporan</div>
        </a>
    </div>
</div>

<!-- ── CHART + RECENT TRANSACTIONS ─────────────────────────────── -->
<div class="row g-4 mb-4">
    <!-- Chart -->
    <div class="col-lg-7">
        <div class="card-qs-modern p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-800 mb-0" style="color:#1e293b;">
                    <i class="bi bi-graph-up-arrow text-success me-2"></i>Ketersediaan Stok Teratas
                </h5>
            </div>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="col-lg-5">
        <div class="card-qs-modern p-4 h-100 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-800 mb-0" style="color:#1e293b;">
                    <i class="bi bi-clock-history text-primary me-2"></i>Transaksi Terbaru
                </h5>
                <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-light fw-600 text-primary rounded-pill px-3">
                    Semua
                </a>
            </div>
            <div class="table-responsive flex-grow-1">
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        @forelse($recentTransactions as $tx)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="ps-0 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 40px; height: 40px; border-radius: 10px; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 1.2rem;">
                                        @if($tx->type === 'in')
                                            <i class="bi bi-arrow-down-circle-fill text-success"></i>
                                        @else
                                            <i class="bi bi-arrow-up-circle-fill text-danger"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-700 text-dark" style="font-size:0.95rem;">{{ $tx->product->name ?? 'Produk Dihapus' }}</div>
                                        <div style="font-size:0.75rem; color:#94a3b8;">{{ $tx->date->format('d M Y') }} &bull; {{ $tx->user->name ?? 'Sistem' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-0 py-3">
                                @if($tx->type === 'in')
                                    <span class="type-badge-in">+ {{ $tx->quantity }}</span>
                                @else
                                    <span class="type-badge-out">- {{ $tx->quantity }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada transaksi terbaru
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('stockChart').getContext('2d');

// Create a gradient for the bars
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(34, 197, 94, 0.8)'); // green-500
gradient.addColorStop(1, 'rgba(21, 128, 61, 0.4)'); // green-700

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Jumlah Stok',
            data: {!! json_encode($chartData) !!},
            backgroundColor: gradient,
            hoverBackgroundColor: 'rgba(22, 163, 74, 1)',
            borderRadius: 8,
            borderSkipped: false,
            barThickness: 35,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                titleColor: '#e2e8f0',
                bodyColor: '#fff',
                borderColor: 'rgba(255,255,255,0.1)',
                borderWidth: 1,
                padding: 12,
                boxPadding: 6,
                usePointStyle: true,
                callbacks: {
                    label: function(context) {
                        return '  Stok Tersedia: ' + context.parsed.y;
                    }
                }
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { 
                    font: { size: 12, family: "'Inter', sans-serif", weight: 500 }, 
                    color: '#64748b',
                    padding: 10
                },
                border: { display: false }
            },
            y: {
                grid: { 
                    color: '#f1f5f9',
                    drawBorder: false,
                },
                ticks: { 
                    font: { size: 12, family: "'Inter', sans-serif" }, 
                    color: '#94a3b8',
                    padding: 15
                },
                border: { display: false, dash: [4, 4] }
            }
        },
        animation: {
            y: {
                duration: 2000,
                easing: 'easeOutElastic'
            }
        }
    }
});
</script>
@endpush
