@extends('layouts.app')
@section('title', 'Manajemen Barang')
@section('topbar-title', 'Manajemen Barang')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Manajemen Barang</h1>
        <p class="page-subtitle">Kelola semua produk inventory Anda</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-qs-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Produk
    </a>
</div>

<!-- Filter & Search -->
<div class="card-qs p-3 mb-3">
    <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="🔍  Cari nama atau kode barang..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select form-select-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-qs-primary btn-sm flex-fill">
                <i class="bi bi-search me-1"></i>Filter
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary flex-fill">Reset</a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card-qs">
    <div class="table-responsive">
        <table class="table table-qs mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="color:#94a3b8;">{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                    <td><code style="background:#f1f5f9;padding:2px 6px;border-radius:4px;font-size:.8rem;">{{ $product->code }}</code></td>
                    <td>
                        <div class="fw-600">{{ $product->name }}</div>
                        @if($product->description)
                            <div style="font-size:.75rem;color:#94a3b8;">{{ Str::limit($product->description, 40) }}</div>
                        @endif
                    </td>
                    <td>
                        <span style="background:#f0fdf4;color:#15803d;padding:2px 10px;border-radius:20px;font-size:.78rem;font-weight:600;">
                            {{ $product->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="fw-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="fw-700">{{ $product->stock }}</span>
                        <span style="color:#94a3b8;font-size:.8rem;"> {{ $product->unit }}</span>
                    </td>
                    <td>
                        <span class="badge rounded-pill {{ $product->stock_badge_class }}" style="font-size:.75rem;padding:4px 10px;">
                            @if($product->stock_status === 'aman') ✅ Aman
                            @elseif($product->stock_status === 'menipis') ⚠️ Menipis
                            @else ❌ Habis
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('products.show', $product) }}"
                               class="btn btn-sm" style="background:#dbeafe;color:#1d4ed8;border-radius:6px;" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}"
                               class="btn btn-sm" style="background:#fef9c3;color:#a16207;border-radius:6px;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#b91c1c;border-radius:6px;" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                        <span class="text-muted">Belum ada produk. <a href="{{ route('products.create') }}">Tambah sekarang</a></span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="px-4 py-3 border-top pagination-qs-wrapper">
        <style>
            .pagination-qs-wrapper nav { margin-bottom: 0; }
            .pagination-qs-wrapper .pagination { margin-bottom: 0; gap: 4px; }
            .pagination-qs-wrapper .page-item .page-link { border-radius: 8px; color: #475569; padding: 0.5rem 0.875rem; border: 1px solid #e2e8f0; font-weight: 500; font-size: 0.875rem; transition: all 0.2s; }
            .pagination-qs-wrapper .page-item .page-link:hover { background-color: #f8fafc; color: #0f172a; }
            .pagination-qs-wrapper .page-item.active .page-link { background-color: #10b981; border-color: #10b981; color: white; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.25); }
            .pagination-qs-wrapper .page-item.disabled .page-link { background-color: #f8fafc; color: #94a3b8; border-color: #e2e8f0; }
            .pagination-qs-wrapper p.small.text-muted { margin-bottom: 0; padding-top: 0.35rem; color: #64748b !important; font-size: 0.875rem; }
        </style>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection
