@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('topbar-title', 'Tambah Produk')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Produk Baru</h1>
        <p class="page-subtitle">Isi data produk dengan lengkap</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:760px;">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-600">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="contoh: Mie Instan Goreng">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-600">Kode Barang <span class="text-danger">*</span></label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                       value="{{ old('code') }}" placeholder="contoh: PRD-011">
                @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Kategori <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Harga Modal (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="capital_price" class="form-control @error('capital_price') is-invalid @enderror"
                       value="{{ old('capital_price', 0) }}" min="0" step="100">
                @error('capital_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Harga Jual (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', 0) }}" min="0" step="100">
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Stok Awal <span class="text-danger">*</span></label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                       value="{{ old('stock', 0) }}" min="0">
                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Stok Minimum <span class="text-danger">*</span></label>
                <input type="number" name="min_stock" class="form-control @error('min_stock') is-invalid @enderror"
                       value="{{ old('min_stock', 5) }}" min="0">
                @error('min_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Satuan <span class="text-danger">*</span></label>
                <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror"
                       value="{{ old('unit', 'pcs') }}" placeholder="pcs, kg, liter...">
                @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-600">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          rows="3" placeholder="Keterangan produk (opsional)">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-qs-primary">
                <i class="bi bi-check-circle me-1"></i>Simpan Produk
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
