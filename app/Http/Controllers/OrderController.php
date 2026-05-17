<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $size = $request->query('size');
        $qty = $request->query('qty', 1); // Ambil kuantitas dari detail produk

        $shipping_cost = 45000; // Contoh ongkos kirim otomatis
        $discount = 0;
        $voucher_msg = null;
        $voucher_status = null;
        $voucher_code = $request->query('voucher');

        // Pengecekan Voucher
        if ($voucher_code) {
            $voucher = Voucher::where('code', $voucher_code)->where('is_active', true)->first();
            if ($voucher) {
                $discount = $voucher->discount_amount;
                $voucher_msg = "Voucher valid! Kamu hemat Rp " . number_format($discount, 0, ',', '.');
                $voucher_status = 'success';
            } else {
                $voucher_msg = "Kode Voucher tidak ditemukan atau sudah tidak aktif.";
                $voucher_status = 'error';
                $voucher_code = null;
            }
        }

        // Kalkulasi Harga Jelas
        $subtotal = $product->price * $qty;
        $total = max(0, $subtotal + $shipping_cost - $discount);

        return view('front.checkout', compact('product', 'size', 'qty', 'shipping_cost', 'discount', 'subtotal', 'total', 'voucher_msg', 'voucher_status', 'voucher_code'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();
        $user = Auth::user();
        $qty = $request->qty;

        if ($product->stock < $qty) {
            return back()->withErrors(['error' => 'Stok tidak mencukupi. Sisa stok: ' . $product->stock]);
        }

        $discount = 0;
        $voucherId = null;

        if ($request->filled('voucher_code')) {
            $voucher = Voucher::where('code', $request->voucher_code)->where('is_active', true)->first();
            if ($voucher) {
                $discount = $voucher->discount_amount;
                $voucherId = $voucher->id;
            }
        }

        $shipping_cost = 45000;
        $subtotal = $product->price * $qty;
        $totalAmount = max(0, $subtotal + $shipping_cost - $discount);

        $path = $request->file('proof_of_payment')->store('payments', 'public');

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => '#FV-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
            'total_amount' => $totalAmount,
            'discount_amount' => $discount,
            'shipping_cost' => $shipping_cost, // Simpan ongkir ke database
            'voucher_id' => $voucherId,
            'proof_of_payment' => $path,
            'delivery_address' => $user->address,
            'status' => 'processing',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $qty,
            'price' => $product->price,
            'size' => $request->size,
        ]);

        $product->decrement('stock', $qty);

        return redirect()->route('orders')->with('success', 'Pembayaran terkirim! Menunggu konfirmasi admin.');
    }

    public function show($id)
    {
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);

        return view('front.order_detail', compact('order'));
    }
}
