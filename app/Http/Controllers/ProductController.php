<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
{
    $products = Product::all(); // Mengambil semua produk dari database
    return view('products.create', compact('products'));
}

public function store(Request $request)
{
    $product = new Product();
    $product->name = $request->input('product_name');
    $product->price = $request->input('product_price');
    $product->save();

    return redirect('/add-product')->with('success', 'Produk berhasil ditambahkan.');
}

}
