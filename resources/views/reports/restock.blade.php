<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Restok Barang - QuickStack</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fff; padding: 2rem; color: #000; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); font-size: 14px; line-height: 24px; color: #333; }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; }
        .invoice-box table td { padding: 5px; vertical-align: top; }
        .title { font-size: 24px; font-weight: bold; color: #16a34a; }
        .subtitle { font-size: 12px; color: #888; margin-bottom: 20px; }
        .table-items { border-collapse: collapse; width: 100%; margin-top: 20px; }
        .table-items th, .table-items td { border: 1px solid #ddd; padding: 8px 12px; }
        .table-items th { background: #f8fafc; font-weight: bold; }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        
        @media print {
            body { padding: 0; background: #fff; }
            .invoice-box { border: none; box-shadow: none; max-width: 100%; }
            .btn-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="title">QUICKSTACK</div>
            <div class="subtitle">Sistem Inventory Digital UMKM</div>
        </div>
        <div class="text-end">
            <h4 class="mb-0">DAFTAR BELANJA (RESTOK)</h4>
            <div style="font-size: 13px;">Tanggal Cetak: {{ now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</div>
            <div style="font-size: 13px;">Dicetak oleh: {{ auth()->user()->name }}</div>
        </div>
    </div>

    <button onclick="window.print()" class="btn btn-success btn-print mb-3">
        Cetak Daftar Belanja
    </button>

    <table class="table-items">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="30%">Nama Barang</th>
                <th width="20%">Kategori</th>
                <th width="15%" class="text-center">Sisa Stok</th>
                <th width="15%" class="text-center">Min. Stok</th>
                <th width="15%" class="text-center">Ceklis</th>
            </tr>
        </thead>
        <tbody>
            @php $currentCategory = null; @endphp
            @forelse($restockProducts as $index => $product)
                
                @if($currentCategory !== $product->category_id)
                    <tr style="background-color: #f1f5f9;">
                        <td colspan="6" style="font-weight: bold; font-size: 12px; text-transform: uppercase;">
                            Kategori: {{ $product->category->name ?? 'Tanpa Kategori' }}
                        </td>
                    </tr>
                    @php $currentCategory = $product->category_id; @endphp
                @endif

                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        <span style="font-size: 11px; color: #666;">Kode: {{ $product->code }}</span>
                    </td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td class="text-center" style="color: {{ $product->stock <= 0 ? 'red' : '#d97706' }}; font-weight: bold;">
                        {{ $product->stock }} {{ $product->unit }}
                    </td>
                    <td class="text-center">{{ $product->min_stock }} {{ $product->unit }}</td>
                    <td class="text-center">
                        <div style="width: 20px; height: 20px; border: 1px solid #666; margin: 0 auto; border-radius: 3px;"></div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Semua stok produk dalam kondisi aman. Tidak ada barang yang perlu dibeli.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 40px; font-size: 12px; color: #666;">
        <p><strong>Catatan:</strong> Daftar ini di-generate otomatis berdasarkan perhitungan sisa stok yang berada di bawah atau sama dengan Batas Stok Minimum masing-masing produk.</p>
    </div>
</div>

</body>
</html>
