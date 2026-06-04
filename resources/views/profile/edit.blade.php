@extends('layouts.app')

@section('title', 'Profil Pengguna')
@section('topbar-title', 'Profil Pengguna')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-qs">
            <div class="card-body p-4">
                <h5 class="mb-4" style="font-weight: 700; color: #1e293b;">Informasi Profil</h5>
                
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label" style="font-size: .85rem; font-weight: 600; color: #475569;">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: .85rem; font-weight: 600; color: #475569;">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if(auth()->user()->hasVerifiedEmail())
                            <div class="form-text text-success" style="font-size: 0.8rem;"><i class="bi bi-check-circle-fill"></i> Email terverifikasi.</div>
                        @else
                            <div class="form-text text-danger" style="font-size: 0.8rem;">
                                <i class="bi bi-exclamation-triangle-fill"></i> Email belum terverifikasi.
                                <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none text-danger fw-semibold" style="font-size: 0.8rem;">Kirim ulang email verifikasi.</button>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: .85rem; font-weight: 600; color: #475569;">Jenis Kelamin</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender', auth()->user()->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender', auth()->user()->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" style="font-size: .85rem; font-weight: 600; color: #475569;">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', auth()->user()->birth_date ? auth()->user()->birth_date->format('Y-m-d') : '') }}">
                        @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-qs-primary">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
