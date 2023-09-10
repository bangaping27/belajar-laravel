<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Ambil data keranjang (misalnya, dari sesi atau database)
        $cartItems = session()->get('cart', []);
    
        // Hitung total harga dari semua item dalam keranjang
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['total_price'];
        }
    
        // Simpan total harga dalam sesi
        session()->put('total_price', $totalPrice);
    
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }
    

public function addToCart(Product $product)
{
    // Lakukan validasi atau logika lainnya jika diperlukan

    // Ambil keranjang dari sesi
    $cart = session()->get('cart', []);

    // Cari apakah produk sudah ada dalam keranjang
    $found = false;
    foreach ($cart as &$item) {
        if ($item['id'] == $product->id) {
            // Jika sudah ada, tingkatkan jumlahnya dan update total harganya
            $item['quantity'] += 1;
            $item['total_price'] = $item['quantity'] * $product->price;
            $found = true;
            break;
        }
    }

    // Jika produk belum ada dalam keranjang, tambahkan sebagai item baru
    if (!$found) {
        $cart[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1, // Jumlah awal
            'total_price' => $product->price, // Total harga awal
        ];
    }

    // Simpan keranjang kembali dalam sesi
    session()->put('cart', $cart);

    // Redirect kembali ke halaman produk
    return redirect()->route('cart.index')->with('success', 'Produk telah ditambahkan ke keranjang.');
}


public function removeFromCart($id)
{
    // Lakukan logika untuk menghapus item dengan ID yang diberikan dari keranjang
    
    // Contoh: Hapus item dari sesi keranjang
    $cart = session()->get('cart', []);

    // Cari item berdasarkan ID dan hapus
    foreach ($cart as $key => $item) {
        if ($item['id'] == $id) {
            unset($cart[$key]);
        }
    }

    // Simpan keranjang kembali dalam sesi
    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Item telah dihapus dari keranjang.');
}

public function removeFromCartSatu($id)
{
    
 //Hapus satu item dari sesi keranjang
    $cart = session()->get('cart', []);

    // Cari item berdasarkan ID
    foreach ($cart as $key => $item) {
        if ($item['id'] == $id) {
            // Jika jumlahnya lebih dari satu, kurangkan satu
            if ($item['quantity'] > 1) {
                $cart[$key]['quantity'] -= 1;
            } else {
                // Jika jumlahnya hanya satu, hapus item
                unset($cart[$key]);
            }
            break; // Keluar dari loop setelah menemukan item
        }
    }

    // Hitung ulang total harga
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['total_price'];
    }

    // Simpan kembali keranjang dan total harga dalam sesi
    session()->put('cart', $cart);
    session()->put('totalPrice', $totalPrice);

    return redirect()->route('cart.index')->with('success', 'Satu item telah dihapus dari keranjang.');
}



public function clearCart()
{
    // Lakukan logika untuk menghapus semua item dari keranjang
    
    // Contoh: Hapus semua item dari sesi keranjang
    session()->forget('cart');

    return redirect()->route('cart.index')->with('success', 'Keranjang telah dikosongkan.');

}

}

