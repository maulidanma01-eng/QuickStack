<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalStock     = Product::sum('stock');
        $lowStock       = Product::whereColumn('stock', '<=', 'min_stock')->where('stock', '>', 0)->count();
        $outOfStock     = Product::where('stock', '<=', 0)->count();

        $recentTransactions = TransactionHistory::with(['product', 'user'])
            ->latest()
            ->take(8)
            ->get();

        $todaySales = TransactionHistory::with('product')
            ->whereDate('date', now()->toDateString())
            ->where('type', 'out')
            ->get()
            ->sum(function ($tx) {
                return $tx->quantity * ($tx->product->price ?? 0);
            });

        // Top 7 products by stock for chart
        $chartProducts = Product::orderBy('stock', 'desc')->take(7)->get();
        $chartLabels   = $chartProducts->pluck('name');
        $chartData     = $chartProducts->pluck('stock');

        // Monthly stock in vs out (last 6 months)
        $months = collect(range(5, 0))->map(fn($i) => now()->subMonths($i));

        return view('dashboard.index', compact(
            'totalProducts',
            'totalStock',
            'lowStock',
            'outOfStock',
            'todaySales',
            'recentTransactions',
            'chartLabels',
            'chartData'
        ));
    }
}
