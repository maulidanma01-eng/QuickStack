@extends('layouts.app')
@section('title', 'Edit Produk')
@section('topbar-title', 'Edit Produk')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Produk</h1>
        <p class="page-subtitle">Perbarui data produk: <strong>{{ $product->name }}</strong></p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:760px;">
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-600">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $product->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-600">Kode Barang <span class="text-danger">*</span></label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                       value="{{ old('code', $product->code) }}">
                @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Kategori <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Harga Modal (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="capital_price" class="form-control @error('capital_price') is-invalid @enderror"
                       value="{{ old('capital_price', floatval($product->capital_price)) }}" min="0" step="100">
                @error('capital_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Harga Jual (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', floatval($product->price)) }}" min="0" step="100">
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Stok <span class="text-danger">*</span></label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                       value="{{ old('stock', $product->stock) }}" min="0">
                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Stok Minimum <span class="text-danger">*</span></label>
                <input type="number" name="min_stock" class="form-control @error('min_stock') is-invalid @enderror"
                       value="{{ old('min_stock', $product->min_stock) }}" min="0">
                @error('min_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-600">Satuan <span class="text-danger">*</span></label>
                <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror"
                       value="{{ old('unit', $product->unit) }}">
                @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-600">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-qs-primary">
                <i class="bi bi-check-circle me-1"></i>Perbarui Produk
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
