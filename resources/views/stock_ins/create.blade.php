@extends('layouts.app')
@section('title', 'Input Stok Masuk')
@section('topbar-title', 'Input Stok Masuk')

@push('styles')
<!-- Select2 for searchable dropdown -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Input Stok Masuk</h1>
        <p class="page-subtitle">Tambahkan jumlah stok produk ke sistem</p>
    </div>
    <a href="{{ route('stock_ins.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card-qs p-4" style="max-width:700px;">
    <form action="{{ route('stock_ins.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-600">Pilih Produk <span class="text-danger">*</span></label>
            <select name="product_id" id="product_id" class="form-select select2-qs @error('product_id') is-invalid @enderror">
                <option value="">-- Cari Nama / Kode Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-unit="{{ $product->unit }}" data-stock="{{ $product->stock }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        [{{ $product->code }}] {{ $product->name }} — Stok: {{ $product->stock }} {{ $product->unit }}
                    </option>
                @endforeach
            </select>
            @error('product_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            <div id="product-info" class="mt-2 text-muted" style="font-size:.8rem; display:none;">
                Sisa stok saat ini: <strong id="current-stock" class="text-dark"></strong> <span id="product-unit"></span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-600">Jumlah Masuk <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                           value="{{ old('quantity', 1) }}" min="1">
                    <span class="input-group-text" id="unit-label">pcs</span>
                </div>
                @error('quantity')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-600">Tanggal <span class="text-danger">*</span></label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date', date('Y-m-d')) }}">
                @error('date')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-600">Keterangan / Referensi</label>
            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror"
                      rows="2" placeholder="contoh: Pembelian dari supplier A">{{ old('notes') }}</textarea>
            @error('notes')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-qs-primary w-100 py-2">
            <i class="bi bi-save me-2"></i>Simpan Stok Masuk
        </button>
    </form>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-qs').select2({
            theme: 'bootstrap-5',
            placeholder: "-- Cari Nama / Kode Produk --",
            width: '100%'
        });

        $('#product_id').on('change', function() {
            const selected = $(this).find('option:selected');
            if(selected.val()) {
                const unit = selected.data('unit');
                const stock = selected.data('stock');
                $('#unit-label').text(unit);
                $('#current-stock').text(stock);
                $('#product-unit').text(unit);
                $('#product-info').fadeIn();
            } else {
                $('#unit-label').text('pcs');
                $('#product-info').hide();
            }
        });

        // Trigger on load if validation failed
        $('#product_id').trigger('change');
    });
</script>
@endpush
