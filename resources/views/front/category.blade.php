<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori {{ $category->name }} - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300] selection:text-black">
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 w-full max-w-[1200px] mx-auto mt-8 px-4 mb-20">

        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition mb-6 bg-white/50 px-4 py-2 rounded-xl backdrop-blur-md border border-white/60 w-max shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI
        </a>

        <div class="bg-gray-900 rounded-3xl overflow-hidden relative h-[250px] md:h-[300px] mb-12 shadow-lg border border-white/20 flex items-center px-8 md:px-16">
            <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay blur-sm">

            <div class="relative z-10 flex items-center gap-6 md:gap-10">
                <div class="w-32 h-32 md:w-40 md:h-40 bg-white p-2 rounded-full shadow-2xl border-4 border-4 border-[#9CE300]">
                    <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" class="w-full h-full object-cover rounded-full">
                </div>
                <div>
                    <h1 class="text-white text-4xl md:text-6xl font-black italic uppercase tracking-tight drop-shadow-md">{{ $category->name }}</h1>
                    <p class="text-[#9CE300] font-bold mt-2 text-sm md:text-base tracking-widest uppercase">Explore The Collection</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl font-black italic flex items-center gap-2 uppercase tracking-tight text-gray-800">
                <i class="fa-solid fa-shoe-prints text-[#9CE300]"></i> {{ $products->count() }} Products Found
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @forelse($products as $product)
            <a href="{{ route('product.show', $product->slug) }}" class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-3 relative hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between block">
                <div>
                    @if($product->original_price && $product->original_price > $product->price)
                        @php
                            $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                        @endphp
                        <span class="absolute top-4 right-4 bg-[#9CE300]/90 backdrop-blur-sm text-[10px] font-black px-2 py-1 rounded-md z-10 shadow-sm">-{{ $discount }}%</span>
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
                        <div class="w-full bg-gray-200/50 h-1.5 mt-3 rounded-full overflow-hidden backdrop-blur-sm">
                            <div class="bg-[#9CE300] h-full rounded-full" style="{{ $product->stock < 5 ? 'width: 20%; background-color: #ef4444;' : 'width: 75%;' }}"></div>
                        </div>
                        <div class="text-[10px] font-bold text-gray-500 mt-1.5 flex justify-between">
                            <span>STOCK: {{ $product->stock }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-2 md:col-span-4 text-center py-20 bg-white/50 backdrop-blur-md rounded-3xl border border-white/60 shadow-sm">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-ghost text-3xl text-gray-300"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-lg">Belum ada produk</h3>
                <p class="text-sm text-gray-500 mt-1">Belum ada produk yang ditambahkan di kategori ini.</p>
            </div>
            @endforelse
        </div>
    </main>

    @include('front.layouts.footer')

</body>
</html>
