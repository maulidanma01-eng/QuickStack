@extends('layouts.app')
@section('title', 'Laporan')
@section('topbar-title', 'Laporan & Analitik')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Laporan Sistem</h1>
        <p class="page-subtitle">Pantau kondisi inventory dan pergerakan stok</p>
    </div>
    <button onclick="window.print()" class="btn btn-outline-secondary">
        <i class="bi bi-printer me-1"></i>Cetak Laporan
    </button>
</div>

<div class="row g-4">
    <!-- Peringatan Stok Rendah -->
    <div class="col-lg-6">
        <div class="card-qs p-4 h-100 border-top border-warning border-4 rounded-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="fw-700 text-warning mb-0">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Produk Stok Menipis / Habis
                </h6>
                <a href="{{ route('reports.restock') }}" target="_blank" class="btn btn-sm btn-warning fw-600" style="color:#78350f;">
                    <i class="bi bi-cart-check me-1"></i>Daftar Belanja
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr style="font-size:.75rem;color:#94a3b8;text-transform:uppercase;">
                            <th>Barang</th>
                            <th class="text-end">Sisa Stok</th>
                            <th class="text-end">Min. Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $product)
                        <tr>
                            <td>
                                <div class="fw-600" style="font-size:.85rem;">{{ $product->name }}</div>
                                <div style="font-size:.7rem;color:#94a3b8;">{{ $product->code }}</div>
                            </td>
                            <td class="text-end fw-700 {{ $product->stock <= 0 ? 'text-danger' : 'text-warning' }}">
                                {{ $product->stock }}
                            </td>
                            <td class="text-end" style="color:#64748b;font-size:.85rem;">{{ $product->min_stock }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-3 text-muted" style="font-size:.85rem;">
                                Semua stok produk dalam kondisi aman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Produk Paling Banyak Keluar -->
    <div class="col-lg-6">
        <div class="card-qs p-4 h-100 border-top border-primary border-4 rounded-3">
            <h6 class="fw-700 mb-3 text-primary">
                <i class="bi bi-graph-up-arrow me-2"></i>Top 10 Barang Paling Sering Keluar
            </h6>
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr style="font-size:.75rem;color:#94a3b8;text-transform:uppercase;">
                            <th>Peringkat</th>
                            <th>Barang</th>
                            <th class="text-end">Total Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topStockOut as $index => $item)
                        <tr>
                            <td class="fw-600 text-muted">#{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-600" style="font-size:.85rem;">{{ $item->product->name ?? 'Produk Dihapus' }}</div>
                            </td>
                            <td class="text-end fw-700 text-primary">
                                {{ $item->total_out }} <span style="font-size:.7rem;color:#94a3b8;">{{ $item->product->unit ?? '' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-3 text-muted" style="font-size:.85rem;">
                                Belum ada data pengeluaran barang.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat Filter Date -->
    <div class="col-12">
        <div class="card-qs p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-700 mb-0">
                    <i class="bi bi-calendar3 text-success me-2"></i>Laporan Pergerakan Stok
                </h6>
            </div>

            <!-- Filter -->
            <div class="mb-4 p-3 rounded-3" style="background:#f8fafc;">
                <form action="{{ route('reports.index') }}" method="GET" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:.8rem;font-weight:600;color:#64748b;">Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:.8rem;font-weight:600;color:#64748b;">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-qs-primary flex-fill">Tampilkan</button>
                        <a href="{{ route('reports.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Financial Summary -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3 rounded-3" style="background:#f0fdf4; border:1px solid #bbf7d0;">
                        <div class="text-success fw-600 mb-1" style="font-size:0.85rem;"><i class="bi bi-cash-stack me-1"></i>Rekap Penjualan (Omzet)</div>
                        <div class="fw-700 fs-5 text-success">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
                        <div style="font-size:0.7rem; color:#15803d; margin-top:0.25rem;">Pada periode yang dipilih</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded-3" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <div class="text-primary fw-600 mb-1" style="font-size:0.85rem;"><i class="bi bi-graph-up me-1"></i>Perkiraan Laba Kotor</div>
                        <div class="fw-700 fs-5 text-primary">Rp {{ number_format($grossProfit, 0, ',', '.') }}</div>
                        <div style="font-size:0.7rem; color:#64748b; margin-top:0.25rem;">Total Harga Jual dikurangi Total Harga Modal</div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-qs table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $tx)
                        <tr>
                            <td style="font-size:.85rem;">{{ $tx->date->format('d M Y') }}</td>
                            <td class="fw-600" style="font-size:.85rem;">{{ $tx->product->name ?? '-' }}</td>
                            <td>
                                @if($tx->type === 'in')
                                    <span style="color:#15803d;font-weight:600;font-size:.8rem;">Stok Masuk</span>
                                @else
                                    <span style="color:#b91c1c;font-weight:600;font-size:.8rem;">Stok Keluar</span>
                                @endif
                            </td>
                            <td class="fw-700">{{ $tx->quantity }}</td>
                            <td style="color:#64748b;font-size:.85rem;">{{ $tx->notes ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Tidak ada data pada rentang tanggal tersebut.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($history->hasPages())
            <div class="mt-3">
                {{ $history->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    @media print {
        body { background: #fff !important; }
        #sidebar, #topbar, form, .btn, .page-header button { display: none !important; }
        #main { margin-left: 0 !important; padding-top: 0 !important; }
        .card-qs { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
    }
</style>

@endsection
