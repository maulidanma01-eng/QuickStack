@extends('layouts.app')
@section('title', 'Edit Pengguna')
@section('topbar-title', 'Edit Pengguna')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Pengguna</h1>
        <p class="page-subtitle">Perbarui informasi akun: <strong>{{ $user->name }}</strong></p>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:600px;">
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-600">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-600">Alamat Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <hr class="my-4">
        <h6 class="fw-700 text-muted mb-3"><i class="bi bi-lock me-2"></i>Ubah Password (Opsional)</h6>
        <p class="text-muted" style="font-size: .85rem;">Kosongkan jika Anda tidak ingin mengubah password.</p>

        <div class="mb-3">
            <label class="form-label fw-600">Password Baru</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Minimal 8 karakter">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-600">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Ulangi password baru">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-qs-primary">
                <i class="bi bi-check-circle me-1"></i>Perbarui Pengguna
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
