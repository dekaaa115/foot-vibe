<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Styling khusus untuk input bintang ulasan */
        .star-rating input { display: none; }
        .star-rating label { color: #d1d5db; cursor: pointer; transition: color 0.2s; }
        .star-rating input:checked ~ label { color: #eab308; }
        .star-rating label:hover, .star-rating label:hover ~ label { color: #eab308; }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300]">
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 w-full max-w-[800px] mx-auto mt-8 px-4 mb-20">

        <a href="{{ route('orders') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition mb-6 bg-white/50 px-4 py-2 rounded-xl backdrop-blur-md border border-white/60 w-max shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI KE DAFTAR PESANAN
        </a>

        @if(session('success'))
        <div class="mb-6 p-4 bg-[#9CE300] text-black font-bold text-sm rounded-2xl shadow-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
        </div>
        @endif

        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-6 md:p-8 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row justify-between md:items-center border-b border-gray-200/50 pb-6 mb-6 gap-4">
                <div>
                    <div class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-1">Order ID</div>
                    <h1 class="text-2xl font-black text-gray-900">{{ $order->order_number }}</h1>
                    <p class="text-sm font-semibold text-gray-500 mt-1">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
                <div>
                    @if($order->status == 'delivered')
                    <div class="bg-[#9CE300]/20 text-green-700 text-xs font-black px-4 py-2 rounded-xl border border-[#9CE300]/30 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-check-circle text-base"></i> SELESAI (DELIVERED)
                    </div>
                    @elseif($order->status == 'processing')
                    <div class="bg-blue-100 text-blue-700 text-xs font-black px-4 py-2 rounded-xl border border-blue-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-spinner animate-spin text-base"></i> SEDANG DIPROSES
                    </div>
                    @else
                    <div class="bg-red-100 text-red-700 text-xs font-black px-4 py-2 rounded-xl border border-red-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-xmark-circle text-base"></i> DIBATALKAN
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-gray-100/50 p-5 rounded-2xl border border-gray-200/50 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-900 shadow-sm border border-gray-200 text-lg">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div>
                        <h3 class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-1">Nomor Resi Pengiriman</h3>
                        <div class="text-lg font-black text-gray-900 tracking-wider">
                            {{ $order->tracking_number ?? 'Menunggu Pengiriman...' }}
                        </div>
                    </div>
                </div>
                @if($order->tracking_number)
                <button onclick="navigator.clipboard.writeText('{{ $order->tracking_number }}'); alert('Resi disalin!')" class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-xs font-bold hover:text-black hover:border-gray-300 hover:shadow-sm transition flex items-center gap-2">
                    <i class="fa-regular fa-copy"></i> SALIN RESI
                </button>
                @endif
            </div>

            <h3 class="text-sm font-black italic uppercase text-gray-800 mb-4 flex items-center gap-2"><i class="fa-solid fa-box text-[#9CE300]"></i> Item Pesanan</h3>
            <div class="bg-white/60 border border-white/80 rounded-2xl p-4 mb-6 flex flex-col gap-4">
                @foreach($order->items as $item)
                <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex-shrink-0">
                            <img src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900 text-base line-clamp-1">{{ $item->product ? $item->product->name : 'Produk Tidak Diketahui' }}</h4>
                            <div class="text-xs text-gray-500 font-medium mt-1">Size: {{ $item->size ?? '-' }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-black text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            <div class="text-xs font-bold text-gray-400 mt-1">Qty: {{ $item->quantity }}</div>
                        </div>
                    </div>

                    @if($order->status == 'delivered' && $item->product)
                    <details class="mt-4 group bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                        <summary class="list-none cursor-pointer flex items-center justify-between px-4 py-3 text-xs font-black tracking-widest uppercase text-gray-600 hover:bg-gray-100 transition-all">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-star text-yellow-500"></i> BERI ULASAN PRODUK INI</span>
                            <i class="fa-solid fa-chevron-down group-open:rotate-180 transition-transform"></i>
                        </summary>

                        <div class="p-4 bg-white border-t border-gray-200">
                            <form action="{{ route('review.store', $item->product->slug) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-1">Berikan Bintang</label>
                                    <div class="star-rating flex flex-row-reverse justify-end text-2xl">
                                        <input type="radio" id="star5-{{ $item->id }}" name="rating" value="5" required/><label for="star5-{{ $item->id }}"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" id="star4-{{ $item->id }}" name="rating" value="4"/><label for="star4-{{ $item->id }}"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" id="star3-{{ $item->id }}" name="rating" value="3"/><label for="star3-{{ $item->id }}"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" id="star2-{{ $item->id }}" name="rating" value="2"/><label for="star2-{{ $item->id }}"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" id="star1-{{ $item->id }}" name="rating" value="1"/><label for="star1-{{ $item->id }}"><i class="fa-solid fa-star"></i></label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-2">Pendapatmu</label>
                                    <textarea name="comment" rows="2" class="w-full bg-gray-50 px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-[#9CE300] transition text-sm resize-none" placeholder="Bagaimana kualitas produk ini?" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-2">Foto Produk (Opsional)</label>
                                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-gray-900 file:text-white hover:file:bg-[#9CE300] hover:file:text-black transition cursor-pointer bg-gray-50 rounded-xl border border-gray-200 p-2 outline-none">
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-gray-900 text-white text-[10px] font-black tracking-widest uppercase px-6 py-2.5 rounded-lg hover:bg-[#9CE300] hover:text-black transition-all shadow-md">
                                        KIRIM ULASAN
                                    </button>
                                </div>
                            </form>
                        </div>
                    </details>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-black italic uppercase text-gray-800 mb-3 flex items-center gap-2"><i class="fa-solid fa-location-dot text-[#9CE300]"></i> Alamat Pengiriman</h3>
                    <div class="bg-gray-100/50 p-4 rounded-2xl border border-gray-200/50 h-[150px]">
                        <p class="text-sm font-semibold text-gray-900 mb-1">{{ $order->user->name ?? 'Pelanggan' }}</p>
                        <p class="text-xs text-gray-500 font-medium mb-2">{{ $order->user->phone_number ?? '-' }}</p>
                        <p class="text-sm text-gray-600 font-medium leading-relaxed">{{ $order->delivery_address ?? 'Alamat belum diisi.' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-black italic uppercase text-gray-800 mb-3 flex items-center gap-2"><i class="fa-solid fa-money-bill-wave text-[#9CE300]"></i> Rincian Pembayaran</h3>
                    <div class="bg-white/80 p-5 rounded-2xl border border-white shadow-inner h-[150px] flex flex-col justify-center">
                        @php
                            $subtotal = 0;
                            foreach($order->items as $item) {
                                $subtotal += ($item->price * $item->quantity);
                            }
                        @endphp
                        <div class="flex justify-between items-center mb-2 text-sm font-semibold text-gray-600">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2 text-sm font-semibold text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                        <div class="flex justify-between items-center mb-2 text-sm font-bold text-red-500">
                            <span>Diskon Voucher</span>
                            <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="border-t border-gray-200 my-3 pt-3 flex justify-between items-center">
                            <span class="font-black text-gray-900">Total Akhir</span>
                            <span class="font-black text-xl text-[#8acc00]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('front.layouts.footer')
</body>
</html>
