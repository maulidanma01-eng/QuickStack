@extends('layouts.app')
@section('title', 'Kategori Barang')
@section('topbar-title', 'Kategori Barang')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Kategori Barang</h1>
        <p class="page-subtitle">Kelola kategori produk untuk memudahkan pengelompokan</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-qs-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Kategori
    </a>
</div>

<div class="card-qs p-4">
    <div class="table-responsive">
        <table class="table table-qs mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Jumlah Produk</th>
                    <th style="width: 120px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td style="color:#94a3b8;">{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                    <td class="fw-600" style="color:#1e293b;">{{ $category->name }}</td>
                    <td style="color:#64748b;font-size:.85rem;">{{ $category->description ?? '-' }}</td>
                    <td class="text-center">
                        <span class="badge rounded-pill" style="background:#f1f5f9;color:#475569;font-weight:600;padding:6px 12px;font-size:.8rem;">
                            {{ $category->products_count }} produk
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="btn btn-sm" style="background:#fef9c3;color:#a16207;border-radius:6px;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini? Pastikan kategori ini tidak memiliki produk.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#b91c1c;border-radius:6px;" title="Hapus"
                                        {{ $category->products_count > 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-tags fs-1 d-block mb-2 text-muted"></i>
                        <span class="text-muted">Belum ada kategori. <a href="{{ route('categories.create') }}">Tambah kategori</a></span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($categories->hasPages())
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
    @endif
</div>

@endsection
