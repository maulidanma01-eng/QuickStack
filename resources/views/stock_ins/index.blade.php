@extends('layouts.app')
@section('title', 'Stok Masuk')
@section('topbar-title', 'Stok Masuk')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Riwayat Stok Masuk</h1>
        <p class="page-subtitle">Daftar penambahan stok produk ke inventory</p>
    </div>
    <a href="{{ route('stock_ins.create') }}" class="btn btn-qs-primary">
        <i class="bi bi-plus-circle me-1"></i>Input Stok Masuk
    </a>
</div>

<div class="card-qs p-4">
    <div class="table-responsive">
        <table class="table table-qs mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Admin/User</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockIns as $stockIn)
                <tr>
                    <td style="color:#64748b;font-size:.85rem;">{{ $stockIn->date->format('d M Y') }}</td>
                    <td class="fw-600" style="color:#1e293b;">
                        {{ $stockIn->product->name ?? 'Produk Dihapus' }}
                        @if($stockIn->product)
                            <br><code style="background:#f1f5f9;padding:1px 4px;border-radius:3px;font-size:.7rem;">{{ $stockIn->product->code }}</code>
                        @endif
                    </td>
                    <td>
                        <span class="badge rounded-pill" style="background:#dcfce7;color:#15803d;padding:6px 12px;font-size:.85rem;">
                            + {{ $stockIn->quantity }} {{ $stockIn->product->unit ?? '' }}
                        </span>
                    </td>
                    <td style="color:#64748b;font-size:.85rem;">{{ $stockIn->notes ?? '-' }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle text-muted fs-5"></i>
                            <span style="font-size:.85rem;font-weight:500;">{{ $stockIn->user->name ?? '-' }}</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-arrow-down-circle fs-1 d-block mb-2 text-muted"></i>
                        <span class="text-muted">Belum ada data stok masuk.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($stockIns->hasPages())
    <div class="mt-4">
        {{ $stockIns->links() }}
    </div>
    @endif
</div>

@endsection
