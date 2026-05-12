@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('topbar-title', 'Riwayat Transaksi')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Riwayat Transaksi</h1>
        <p class="page-subtitle">Seluruh log aktivitas keluar masuk barang</p>
    </div>
</div>

<div class="card-qs p-3 mb-3">
    <form action="{{ route('transactions.index') }}" method="GET" class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="🔍  Cari nama barang..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="type" class="form-select form-select-sm">
                <option value="">Semua Jenis Transaksi</option>
                <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Stok Masuk</option>
                <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Stok Keluar</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-qs-primary btn-sm flex-fill">
                <i class="bi bi-search me-1"></i>Filter
            </button>
            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline-secondary flex-fill">Reset</a>
        </div>
    </form>
</div>

<div class="card-qs">
    <div class="table-responsive">
        <table class="table table-qs mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $tx)
                <tr>
                    <td style="color:#64748b;font-size:.85rem;">{{ $tx->date->format('d/m/Y') }}</td>
                    <td class="fw-600" style="color:#1e293b;">
                        {{ $tx->product->name ?? 'Produk Dihapus' }}
                        @if($tx->product)
                            <br><span style="color:#94a3b8;font-size:.75rem;">{{ $tx->product->code }}</span>
                        @endif
                    </td>
                    <td>
                        @if($tx->type === 'in')
                            <span style="background:#dcfce7;color:#15803d;border-radius:6px;padding:4px 12px;font-size:.75rem;font-weight:600;">
                                <i class="bi bi-arrow-down-circle me-1"></i>Stok Masuk
                            </span>
                        @else
                            <span style="background:#fee2e2;color:#b91c1c;border-radius:6px;padding:4px 12px;font-size:.75rem;font-weight:600;">
                                <i class="bi bi-arrow-up-circle me-1"></i>Stok Keluar
                            </span>
                        @endif
                    </td>
                    <td>
                        <strong class="{{ $tx->type === 'in' ? 'text-success' : 'text-danger' }}">
                            {{ $tx->type === 'in' ? '+' : '-' }} {{ $tx->quantity }}
                        </strong>
                        <span style="color:#94a3b8;font-size:.8rem;">{{ $tx->product->unit ?? '' }}</span>
                    </td>
                    <td style="font-size:.85rem;">{{ $tx->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-clock-history fs-1 d-block mb-2 text-muted"></i>
                        <span class="text-muted">Belum ada riwayat transaksi.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transactions->hasPages())
    <div class="p-3 border-top">
        {{ $transactions->links() }}
    </div>
    @endif
</div>

@endsection
