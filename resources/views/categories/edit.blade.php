@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('topbar-title', 'Edit Kategori')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Kategori</h1>
        <p class="page-subtitle">Perbarui informasi kategori produk</p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:600px;">
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-600">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $category->name) }}">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-600">Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                      rows="3">{{ old('description', $category->description) }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-qs-primary">
            <i class="bi bi-check-circle me-1"></i>Perbarui Kategori
        </button>
    </form>
</div>

@endsection
