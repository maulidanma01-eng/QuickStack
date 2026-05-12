@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('topbar-title', 'Tambah Pengguna')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Pengguna Baru</h1>
        <p class="page-subtitle">Daftarkan akun untuk admin atau kasir lain</p>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:600px;">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-600">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="Nama Pengguna" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-600">Alamat Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="email@contoh.com" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-600">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Minimal 8 karakter" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-600">Konfirmasi Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Ulangi password" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-qs-primary">
                <i class="bi bi-check-circle me-1"></i>Simpan Pengguna
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
