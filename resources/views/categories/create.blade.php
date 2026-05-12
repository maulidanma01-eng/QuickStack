@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('topbar-title', 'Tambah Kategori')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Kategori Baru</h1>
        <p class="page-subtitle">Kelompokkan produk Anda dengan kategori</p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:600px;">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-600">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="contoh: Minuman">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-600">Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                      rows="3" placeholder="Keterangan singkat tentang kategori ini">{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-qs-primary">
            <i class="bi bi-check-circle me-1"></i>Simpan Kategori
        </button>
    </form>
</div>

@endsection
