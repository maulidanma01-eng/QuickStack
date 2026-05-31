@extends('layouts.public')
@section('title', 'Katalog Produk')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #0f172a 0%, #1a2e1a 50%, #0f2d0f 100%);
        padding: 4rem 0 5rem;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 50% 0%, rgba(34,197,94,.15) 0%, transparent 70%);
    }
    .hero-title {
        color: #fff;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        position: relative; z-index: 1;
    }
    .hero-subtitle {
        color: #cbd5e1;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        position: relative; z-index: 1;
    }

    /* Search Bar Overlay */
    .search-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        margin-top: -3.5rem;
        position: relative; z-index: 2;
        border: 1px solid rgba(226,232,240,0.8);
    }
    
    .search-input {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        transition: all 0.2s;
    }
    .search-input:focus {
        background: #fff;
        border-color: var(--qs-green);
        box-shadow: 0 0 0 4px rgba(34,197,94,0.1);
    }

    /* Product Cards */
    .product-card {
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.06);
        border-color: #e2e8f0;
    }
    .product-card:hover .product-img {
        transform: scale(1.05);
    }
    .product-img-placeholder {
        height: 180px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        display: flex; align-items: center; justify-content: center;
        color: #94a3b8;
        font-size: 3rem;
    }
    .product-body {
        padding: 1.25rem;
    }
    .product-category {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--qs-green-dark);
        background: var(--qs-green-light);
        padding: 0.2rem 0.6rem;
        border-radius: 6px;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.3rem;
        line-height: 1.3;
    }
    .product-code {
        font-size: 0.75rem;
        color: #94a3b8;
        font-family: monospace;
        background: #f1f5f9;
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        margin-bottom: 1rem;
        display: inline-block;
    }
    .product-price {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--qs-green);
        margin-bottom: 0.75rem;
    }
    
    .stock-badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .stock-available { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .stock-empty { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    .category-filter {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    .category-filter::-webkit-scrollbar { display: none; }
    
    .cat-btn {
        white-space: nowrap;
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        transition: all 0.2s;
        text-decoration: none;
    }
    .cat-btn:hover {
        background: #f8fafc;
        color: #1e293b;
    }
    .cat-btn.active {
        background: var(--qs-green);
        border-color: var(--qs-green);
        color: #fff;
        box-shadow: 0 4px 12px rgba(22,163,74,0.25);
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Katalog Produk UMKM</h1>
        <p class="hero-subtitle">Cari dan lihat ketersediaan stok produk kebutuhan Anda dengan mudah dan *real-time*.</p>
    </div>
</section>

<!-- Search & Content Section -->
<section class="container pb-5">
    
    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="search-card">
                <form action="{{ route('catalog') }}" method="GET" class="d-flex gap-2">
                    <!-- Preserve category if selected -->
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 border-e2e8f0 ps-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control search-input border-start-0 ps-1" 
                               placeholder="Cari nama barang..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-success px-4 fw-600 rounded-3" style="background:var(--qs-green); border:none;">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="category-filter">
        <a href="{{ route('catalog', ['search' => request('search')]) }}" 
           class="cat-btn {{ !request('category') ? 'active' : '' }}">
            Semua Kategori
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('catalog', ['category' => $cat->id, 'search' => request('search')]) }}" 
               class="cat-btn {{ request('category') == $cat->id ? 'active' : '' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <!-- Results Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-700 text-dark mb-0">
            @if(request('search'))
                Hasil pencarian untuk "{{ request('search') }}"
            @else
                Semua Produk
            @endif
        </h5>
        <span class="text-muted" style="font-size:0.9rem;">Menampilkan {{ $products->total() }} produk</span>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="product-card">
                    <!-- Use local image if exists, else fallback to initials -->
                    <div class="product-img-placeholder" style="background:#f1f5f9; padding:0; overflow:hidden;">
                        @php
                            $extensions = ['png', 'jpg', 'jpeg'];
                            $hasImage = false;
                            $imagePath = '';
                            foreach($extensions as $ext) {
                                if(file_exists(public_path('images/products/' . $product->code . '.' . $ext))) {
                                    $imagePath = 'images/products/' . $product->code . '.' . $ext;
                                    $hasImage = true;
                                    break;
                                }
                            }
                        @endphp

                        @if($hasImage)
                            <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover; transition: transform 0.3s;" class="product-img" loading="lazy">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=random&color=fff&size=400&font-size=0.4" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover; transition: transform 0.3s;" class="product-img" loading="lazy">
                        @endif
                    </div>
                    
                    <div class="product-body">
                        <div class="product-category">{{ $product->category->name ?? 'Tanpa Kategori' }}</div>
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="product-code">{{ $product->code }}</div>
                        
                        <div class="product-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            <span class="text-muted" style="font-size:0.8rem; font-weight:500;">/ {{ $product->unit }}</span>
                        </div>
                        
                        <div class="mt-3 pt-3 border-top">
                            @if($product->stock > 0)
                                <div class="stock-badge stock-available w-100 justify-content-center">
                                    <i class="bi bi-check-circle-fill"></i> Stok Tersedia ({{ $product->stock }})
                                </div>
                            @else
                                <div class="stock-badge stock-empty w-100 justify-content-center">
                                    <i class="bi bi-x-circle-fill"></i> Stok Habis
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="bi bi-search"></i></div>
                <h4 class="fw-700 text-slate-700">Produk tidak ditemukan</h4>
                <p class="text-muted">Coba gunakan kata kunci lain atau hapus filter kategori.</p>
                <a href="{{ route('catalog') }}" class="btn btn-outline-secondary mt-2">Reset Pencarian</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @endif

</section>

@endsection
