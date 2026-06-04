@extends('layouts.public')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 64px; height: 64px;">
                            <i class="bi bi-envelope-check" style="font-size: 2rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Verifikasi Email Anda</h4>
                        <p class="text-muted small">
                            Terima kasih telah mendaftar! Anda perlu memverifikasi alamat email Anda terlebih dahulu, dengan menekan tombol tautan di dalam email yang baru saja kami kirimkan.
                        </p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success mt-3" style="border-radius: 10px; font-size: 0.85rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 py-2 rounded-3 fw-semibold">
                                Kirim Ulang Tautan Verifikasi
                            </button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('profile.edit') }}" class="text-success text-decoration-none" style="font-size: 0.9rem;">
                                Edit Profil (Ganti Email)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
