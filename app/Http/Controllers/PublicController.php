<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Fetch products paginated
        $products = $query->orderBy('name')->paginate(12)->withQueryString();

        // Fetch categories for filter dropdown
        $categories = Category::has('products')->orderBy('name')->get();

        return view('public.catalog', compact('products', 'categories'));
    }

    public function help()
    {
        return view('public.help');
    }
}
