<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('user')->latest();
        
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $products = $query->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'supplier') {
            return redirect()->route('products.index')->with('error', 'Only suppliers can add products.');
        }
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:seeds,fertilizers,tools',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Auth::user()->products()->create($request->all());

        return redirect()->route('products.my-products')->with('success', 'Product listed successfully.');
    }

    public function myProducts()
    {
        if (Auth::user()->role !== 'supplier') {
            return redirect()->route('products.index');
        }
        $products = Auth::user()->products()->latest()->get();
        return view('products.my-products', compact('products'));
    }

    public function buy(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
            'status' => 'pending',
        ]);

        $product->decrement('stock_quantity', $request->quantity);

        return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
    }
}
