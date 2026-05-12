<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name'     => 'Admin QuickStack',
            'email'    => 'admin@quickstack.id',
            'password' => Hash::make('password'),
        ]);

        // Categories
        $categories = [
            ['name' => 'Makanan & Minuman', 'description' => 'Produk makanan dan minuman'],
            ['name' => 'Sembako',            'description' => 'Kebutuhan pokok sehari-hari'],
            ['name' => 'Kebersihan',         'description' => 'Produk kebersihan dan sanitasi'],
            ['name' => 'Alat Tulis',         'description' => 'Perlengkapan kantor dan tulis'],
            ['name' => 'Elektronik',         'description' => 'Perangkat dan aksesori elektronik'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Products (with capital_price)
        $products = [
            ['category_id' => 1, 'name' => 'Mie Instan Goreng',    'code' => 'PRD-001', 'capital_price' => 2800, 'price' => 3500,   'stock' => 120, 'min_stock' => 20, 'unit' => 'pcs',  'description' => 'Mie instan rasa goreng'],
            ['category_id' => 1, 'name' => 'Kopi Sachet',          'code' => 'PRD-002', 'capital_price' => 1200, 'price' => 1500,   'stock' => 4,   'min_stock' => 10, 'unit' => 'pcs',  'description' => 'Kopi instan sachet'],
            ['category_id' => 1, 'name' => 'Air Mineral 600ml',    'code' => 'PRD-003', 'capital_price' => 2000, 'price' => 3000,   'stock' => 0,   'min_stock' => 24, 'unit' => 'botol','description' => 'Air mineral kemasan botol'],
            ['category_id' => 2, 'name' => 'Beras Premium 5kg',    'code' => 'PRD-004', 'capital_price' => 65000, 'price' => 75000,  'stock' => 30,  'min_stock' => 5,  'unit' => 'sak',  'description' => 'Beras premium kualitas tinggi'],
            ['category_id' => 2, 'name' => 'Gula Pasir 1kg',       'code' => 'PRD-005', 'capital_price' => 12000, 'price' => 14000,  'stock' => 3,   'min_stock' => 5,  'unit' => 'kg',   'description' => 'Gula pasir putih'],
            ['category_id' => 2, 'name' => 'Minyak Goreng 1L',     'code' => 'PRD-006', 'capital_price' => 15000, 'price' => 18000,  'stock' => 25,  'min_stock' => 10, 'unit' => 'liter','description' => 'Minyak goreng sawit'],
            ['category_id' => 3, 'name' => 'Sabun Mandi',          'code' => 'PRD-007', 'capital_price' => 3500, 'price' => 4500,   'stock' => 60,  'min_stock' => 10, 'unit' => 'pcs',  'description' => 'Sabun mandi batang'],
            ['category_id' => 3, 'name' => 'Deterjen Bubuk 1kg',   'code' => 'PRD-008', 'capital_price' => 14000, 'price' => 16000,  'stock' => 2,   'min_stock' => 5,  'unit' => 'pcs',  'description' => 'Deterjen bubuk cuci baju'],
            ['category_id' => 4, 'name' => 'Pulpen Hitam',         'code' => 'PRD-009', 'capital_price' => 1800, 'price' => 2500,   'stock' => 100, 'min_stock' => 20, 'unit' => 'pcs',  'description' => 'Pulpen tinta hitam'],
            ['category_id' => 5, 'name' => 'Baterai AA',           'code' => 'PRD-010', 'capital_price' => 6000, 'price' => 8000,   'stock' => 0,   'min_stock' => 10, 'unit' => 'pasang','description' => 'Baterai AA alkaline'],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }

        // Sample stock-in transactions
        $stockIns = [
            ['product_id' => 1, 'quantity' => 50,  'date' => now()->subDays(10), 'notes' => 'Restock dari supplier'],
            ['product_id' => 4, 'quantity' => 20,  'date' => now()->subDays(8),  'notes' => 'Pembelian rutin'],
            ['product_id' => 7, 'quantity' => 30,  'date' => now()->subDays(5),  'notes' => 'Restock'],
            ['product_id' => 9, 'quantity' => 100, 'date' => now()->subDays(3),  'notes' => 'Order baru'],
            ['product_id' => 6, 'quantity' => 15,  'date' => now()->subDays(1),  'notes' => 'Restock rutin'],
        ];

        foreach ($stockIns as $si) {
            StockIn::create(array_merge($si, ['user_id' => $admin->id]));
            TransactionHistory::create(array_merge($si, ['user_id' => $admin->id, 'type' => 'in']));
        }

        // Sample stock-out transactions
        $stockOuts = [
            ['product_id' => 1, 'quantity' => 30, 'date' => now()->subDays(7),  'notes' => 'Penjualan harian'],
            ['product_id' => 4, 'quantity' => 5,  'date' => now()->subDays(6),  'notes' => 'Penjualan'],
            ['product_id' => 7, 'quantity' => 10, 'date' => now()->subDays(4),  'notes' => 'Penjualan'],
            ['product_id' => 9, 'quantity' => 20, 'date' => now()->subDays(2),  'notes' => 'Penjualan alat tulis'],
            ['product_id' => 6, 'quantity' => 5,  'date' => now()->subDays(1),  'notes' => 'Penjualan'],
        ];

        foreach ($stockOuts as $so) {
            StockOut::create(array_merge($so, ['user_id' => $admin->id]));
            TransactionHistory::create(array_merge($so, ['user_id' => $admin->id, 'type' => 'out']));
        }
    }
}
