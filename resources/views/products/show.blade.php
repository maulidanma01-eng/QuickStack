@extends('layouts.app')
@section('title', $product->name)
@section('topbar-title', 'Detail Produk')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">{{ $product->name }}</h1>
        <p class="page-subtitle">Detail informasi produk</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm" style="background:#fef9c3;color:#a16207;border-radius:8px;font-weight:600;">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<div class="row g-3">
    <!-- Product Info -->
    <div class="col-lg-4">
        <div class="card-qs p-4">
            <div class="text-center mb-3">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#16a34a,#22c55e);
                            border-radius:20px;display:flex;align-items:center;justify-content:center;
                            font-size:2.5rem;color:#fff;margin:0 auto;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h5 class="mt-3 mb-0 fw-700">{{ $product->name }}</h5>
                <code style="background:#f1f5f9;padding:2px 8px;border-radius:4px;font-size:.85rem;">
                    {{ $product->code }}
                </code>
            </div>

            <div class="text-center mb-3">
                <span class="badge rounded-pill {{ $product->stock_badge_class }}" style="font-size:.85rem;padding:6px 16px;">
                    @if($product->stock_status === 'aman') ✅ Stok Aman
                    @elseif($product->stock_status === 'menipis') ⚠️ Stok Menipis
                    @else ❌ Stok Habis
                    @endif
                </span>
            </div>

            <table class="table table-sm mb-0">
                <tr><td class="text-muted">Kategori</td><td class="fw-600">{{ $product->category->name ?? '-' }}</td></tr>
                <tr><td class="text-muted">Harga Modal</td><td class="fw-600">Rp {{ number_format($product->capital_price, 0, ',', '.') }}</td></tr>
                <tr><td class="text-muted">Harga Jual</td><td class="fw-600 text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</td></tr>
                <tr><td class="text-muted">Stok</td><td class="fw-700 text-success fs-5">{{ $product->stock }} {{ $product->unit }}</td></tr>
                <tr><td class="text-muted">Stok Min.</td><td class="fw-600">{{ $product->min_stock }} {{ $product->unit }}</td></tr>
                <tr><td class="text-muted">Satuan</td><td class="fw-600">{{ $product->unit }}</td></tr>
            </table>

            @if($product->description)
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;">
                <div style="font-size:.75rem;color:#94a3b8;font-weight:600;text-transform:uppercase;">Deskripsi</div>
                <div style="font-size:.875rem;color:#475569;">{{ $product->description }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Transaction History -->
    <div class="col-lg-8">
        <div class="card-qs p-4">
            <h6 class="fw-700 mb-3" style="font-weight:700;">
                <i class="bi bi-clock-history text-success me-2"></i>Riwayat Transaksi Produk
            </h6>
            <div class="table-responsive">
                <table class="table table-qs mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Oleh</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product->transactionHistories->sortByDesc('date') as $tx)
                        <tr>
                            <td>{{ $tx->date->format('d/m/Y') }}</td>
                            <td>
                                @if($tx->type === 'in')
                                    <span style="background:#dcfce7;color:#15803d;border-radius:6px;padding:2px 10px;font-size:.75rem;font-weight:600;">
                                        <i class="bi bi-arrow-down me-1"></i>Masuk
                                    </span>
                                @else
                                    <span style="background:#fee2e2;color:#b91c1c;border-radius:6px;padding:2px 10px;font-size:.75rem;font-weight:600;">
                                        <i class="bi bi-arrow-up me-1"></i>Keluar
                                    </span>
                                @endif
                            </td>
                            <td><strong>{{ $tx->quantity }}</strong> {{ $product->unit }}</td>
                            <td style="font-size:.8rem;">{{ $tx->user->name ?? '-' }}</td>
                            <td style="font-size:.8rem;color:#94a3b8;">{{ $tx->notes ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox d-block fs-2 mb-2"></i>Belum ada transaksi
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
