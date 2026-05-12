<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with(['product', 'user'])
            ->latest()
            ->paginate(15);

        return view('stock_ins.index', compact('stockIns'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock_ins.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'date'       => ['required', 'date'],
            'notes'      => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data) {
            $data['user_id'] = Auth::id();

            StockIn::create($data);

            // Increment product stock
            Product::where('id', $data['product_id'])
                ->increment('stock', $data['quantity']);

            // Log history
            TransactionHistory::create(array_merge($data, ['type' => 'in']));
        });

        return redirect()->route('stock_ins.index')
            ->with('success', 'Stok masuk berhasil dicatat!');
    }
}
