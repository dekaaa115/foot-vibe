<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300] selection:text-black">
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none z-0"></div>

    <header class="bg-[#9CE300]/70 backdrop-blur-md py-3 px-6 flex items-center justify-between sticky top-0 z-50 border-b border-white/30 shadow-[0_4px_30px_rgba(0,0,0,0.05)]">
        <div class="flex items-center gap-2 relative z-10">
            <i class="fa-solid fa-shoe-prints text-2xl text-gray-900"></i>
            <a href="{{ route('home') }}" class="font-black text-2xl italic tracking-tighter text-gray-900">FootVibe</a>
        </div>

        <div class="flex-1 max-w-3xl mx-8 relative z-10">
            <form action="{{ route('search') }}" method="GET" class="relative w-full">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search for the latest drops, performance sneakers and more..." class="w-full py-2.5 px-4 rounded-xl shadow-inner bg-white/50 backdrop-blur-sm border border-white/50 outline-none text-sm focus:bg-white/80 transition-all text-gray-800 placeholder-gray-600" required>
                <button type="submit" class="absolute right-0 top-0 bottom-0 bg-gray-900/90 backdrop-blur-sm text-white px-5 rounded-r-xl hover:bg-gray-800 transition">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-6 text-gray-900 text-xl relative z-10">
            <a href="#" class="hover:scale-110 transition-transform duration-200"><i class="fa-solid fa-headset"></i></a>
            <a href="{{ route('orders') }}" class="hover:scale-110 transition-transform duration-200"><i class="fa-solid fa-truck-fast"></i></a>
            <a href="{{ route('cart.index') }}" class="relative hover:scale-110 transition-transform duration-200 cursor-pointer block">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="absolute -top-2 -right-2 bg-white/90 backdrop-blur-sm text-[10px] font-black px-1.5 py-0.5 rounded-full text-gray-900 border border-gray-200 shadow-sm">
                    {{ Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') : '0' }}
                </span>
            </a>
            <a href="{{ route('profile') }}" class="hover:scale-110 transition-transform duration-200"><i class="fa-regular fa-user"></i></a>
        </div>
    </header>

    <main class="relative z-10 w-full max-w-[1200px] mx-auto mt-8 px-4 mb-20">

        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition mb-6 bg-white/50 px-4 py-2 rounded-xl backdrop-blur-md border border-white/60 w-max shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI
        </a>

        <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-black italic flex items-center gap-2 tracking-tight text-gray-800 uppercase">
                <i class="fa-solid fa-box-open text-[#9CE300]"></i> {{ $title }}
            </h1>
            <span class="text-sm font-bold text-gray-500 bg-white/60 px-3 py-1.5 rounded-lg border border-white/80">{{ $products->count() }} Items</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @forelse($products as $product)
            <a href="{{ route('product.show', $product->slug) }}" class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-3 relative hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between block">
                <div>
                    @if($product->original_price && $product->original_price > $product->price)
                        @php
                            $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                        @endphp
                        <span class="absolute top-4 right-4 bg-red-500 text-white text-[10px] font-black px-2 py-1 rounded-md z-10 shadow-sm">-{{ $discount }}%</span>
                    @endif
                    <div class="bg-black/5 h-48 rounded-2xl mb-4 flex items-center justify-center overflow-hidden relative">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 relative z-10">
                    </div>
                    <div class="px-2 pb-2">
                        <div class="flex flex-wrap items-baseline gap-1.5">
                            <div class="font-black text-xl text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            @if($product->original_price && $product->original_price > $product->price)
                            <div class="text-[11px] text-gray-400 line-through font-medium">Rp {{ number_format($product->original_price, 0, ',', '.') }}</div>
                            @endif
                        </div>
                        <div class="text-xs text-gray-600 font-medium truncate mt-1">{{ $product->name }}</div>
                        <div class="text-[10px] font-bold text-gray-400 mt-2">STOCK: {{ $product->stock }}</div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-20 bg-white/50 backdrop-blur-md rounded-3xl border border-white/60 shadow-sm">
                <h3 class="font-bold text-gray-800 text-lg">Belum ada produk di koleksi ini.</h3>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white/60 backdrop-blur-xl border-t border-white/60 pt-16 pb-6 mt-auto relative z-10 shadow-[0_-10px_30px_rgba(0,0,0,0.02)]">
        <div class="text-center text-[11px] font-bold text-gray-400 border-t border-gray-200/50 pt-6">
            &copy; 2026 FOOTVIBE. All Rights Reserved. Inspired by Shopee Layout.
        </div>
    </footer>
</body>
</html>
