<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['product', 'user'])
            ->latest()
            ->paginate(15);

        return view('stock_outs.index', compact('stockOuts'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->orderBy('name')->get();
        return view('stock_outs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'date'       => ['required', 'date'],
            'notes'      => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->stock < $data['quantity']) {
            return back()->withErrors([
                'quantity' => "Stok tidak mencukupi! Stok tersedia: {$product->stock} {$product->unit}",
            ])->withInput();
        }

        DB::transaction(function () use ($data, $product) {
            $data['user_id'] = Auth::id();

            StockOut::create($data);

            // Decrement product stock
            $product->decrement('stock', $data['quantity']);

            // Log history
            TransactionHistory::create(array_merge($data, ['type' => 'out']));
        });

        return redirect()->route('stock_outs.index')
            ->with('success', 'Stok keluar berhasil dicatat!');
    }
}
