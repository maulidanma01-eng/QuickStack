<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Low stock products
        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock')
            ->get();

        // Top products by stock out
        $topStockOut = StockOut::selectRaw('product_id, SUM(quantity) as total_out')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_out')
            ->take(10)
            ->get();

        // Transaction history with optional date filter
        $historyQuery = TransactionHistory::with(['product', 'user']);

        if ($request->filled('start_date')) {
            $historyQuery->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $historyQuery->whereDate('date', '<=', $request->end_date);
        }

        $history = $historyQuery->latest()->paginate(15)->withQueryString();

        // Calculate Sales and Profit for the filtered period
        $salesQuery = TransactionHistory::with('product')->where('type', 'out');
        if ($request->filled('start_date')) {
            $salesQuery->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $salesQuery->whereDate('date', '<=', $request->end_date);
        }
        
        $salesData = $salesQuery->get();
        $totalSales = $salesData->sum(fn($tx) => $tx->quantity * ($tx->product->price ?? 0));
        $totalCapital = $salesData->sum(fn($tx) => $tx->quantity * ($tx->product->capital_price ?? 0));
        $grossProfit = $totalSales - $totalCapital;

        return view('reports.index', compact('lowStockProducts', 'topStockOut', 'history', 'totalSales', 'grossProfit'));
    }

    public function restock()
    {
        $restockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'min_stock')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        return view('reports.restock', compact('restockProducts'));
    }
}
