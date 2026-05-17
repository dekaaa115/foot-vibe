<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('front.cart', compact('carts'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'size' => 'nullable|string'
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        if ($product->stock < $request->qty) {
            return back()->withErrors(['error' => 'Stok produk tidak mencukupi.']);
        }

        // Cek apakah produk dengan ukuran yang sama sudah ada di keranjang
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->where('size', $request->size)
                            ->first();

        if ($existingCart) {
            // Jika ada, tambahkan saja kuantitasnya
            $existingCart->increment('quantity', $request->qty);
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'size' => $request->size,
                'quantity' => $request->qty,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
