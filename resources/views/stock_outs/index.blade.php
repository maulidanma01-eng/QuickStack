@extends('layouts.app')
@section('title', 'Stok Keluar')
@section('topbar-title', 'Stok Keluar')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Riwayat Stok Keluar</h1>
        <p class="page-subtitle">Daftar pengurangan stok produk (penjualan, rusak, dll)</p>
    </div>
    <a href="{{ route('stock_outs.create') }}" class="btn btn-qs-primary" style="background:linear-gradient(135deg, #dc2626, #ef4444);">
        <i class="bi bi-dash-circle me-1"></i>Input Stok Keluar
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
                @forelse($stockOuts as $stockOut)
                <tr>
                    <td style="color:#64748b;font-size:.85rem;">{{ $stockOut->date->format('d M Y') }}</td>
                    <td class="fw-600" style="color:#1e293b;">
                        {{ $stockOut->product->name ?? 'Produk Dihapus' }}
                        @if($stockOut->product)
                            <br><code style="background:#f1f5f9;padding:1px 4px;border-radius:3px;font-size:.7rem;">{{ $stockOut->product->code }}</code>
                        @endif
                    </td>
                    <td>
                        <span class="badge rounded-pill" style="background:#fee2e2;color:#b91c1c;padding:6px 12px;font-size:.85rem;">
                            - {{ $stockOut->quantity }} {{ $stockOut->product->unit ?? '' }}
                        </span>
                    </td>
                    <td style="color:#64748b;font-size:.85rem;">{{ $stockOut->notes ?? '-' }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle text-muted fs-5"></i>
                            <span style="font-size:.85rem;font-weight:500;">{{ $stockOut->user->name ?? '-' }}</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-arrow-up-circle fs-1 d-block mb-2 text-muted"></i>
                        <span class="text-muted">Belum ada data stok keluar.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($stockOuts->hasPages())
    <div class="mt-4">
        {{ $stockOuts->links() }}
    </div>
    @endif
</div>

@endsection
