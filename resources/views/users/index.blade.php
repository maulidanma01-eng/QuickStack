@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('topbar-title', 'Manajemen Pengguna')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Daftar Pengguna</h1>
        <p class="page-subtitle">Kelola akses akun admin dan kasir</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-qs-primary">
        <i class="bi bi-person-plus me-1"></i>Tambah Pengguna
    </a>
</div>

<div class="card-qs">
    <div class="table-responsive">
        <table class="table table-qs mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:#94a3b8;">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #16a34a, #22c55e); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: .9rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-600">{{ $user->name }}</div>
                                @if(auth()->id() === $user->id)
                                    <span class="badge bg-success" style="font-size: .65rem;">Anda</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td><div style="font-size: .85rem; color: #475569;">{{ $user->email }}</div></td>
                    <td>
                        <span style="font-size: .85rem; color: #64748b;">{{ $user->created_at->format('d M Y') }}</span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-sm" style="background:#fef9c3;color:#a16207;border-radius:6px;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#b91c1c;border-radius:6px;" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people fs-1 d-block mb-2 text-muted"></i>
                        <span class="text-muted">Belum ada pengguna.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-4 py-3 border-top">
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection
