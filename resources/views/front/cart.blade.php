<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300]">
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 w-full max-w-[1000px] mx-auto mt-8 px-4 mb-20">

        <div class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-8 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-800 transition">Home</a>
            <i class="fa-solid fa-angle-right text-[9px]"></i>
            <span class="text-gray-800">Shopping Cart</span>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-[#9CE300] text-black font-bold text-sm rounded-2xl shadow-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
        </div>
        @endif

        <h1 class="text-3xl font-black italic uppercase tracking-tight text-gray-900 mb-8">Keranjang Belanja</h1>

        <div class="flex flex-col gap-5">
            @forelse($carts as $cart)
                <div class="bg-white/60 backdrop-blur-md border border-white/80 rounded-3xl p-5 shadow-sm hover:shadow-md transition-all flex flex-col sm:flex-row gap-5 items-center relative group">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex-shrink-0">
                        <img src="{{ $cart->product->image ? asset('storage/' . $cart->product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>

                    <div class="flex-1 w-full text-center sm:text-left">
                        <h3 class="text-lg font-bold text-gray-900">{{ $cart->product->name }}</h3>
                        <div class="text-sm text-gray-500 font-medium mt-1">Size: {{ $cart->size ?? '-' }}</div>
                        <div class="text-xl font-black text-[#8acc00] mt-2">Rp {{ number_format($cart->product->price, 0, ',', '.') }} <span class="text-xs text-gray-400 font-medium">/ item</span></div>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center justify-center sm:justify-end gap-3 w-full sm:w-auto mt-2 sm:mt-0">
                        <div class="bg-white px-5 py-3 rounded-xl text-sm font-black border border-gray-200 text-gray-700 shadow-inner">
                            Qty: {{ $cart->quantity }}
                        </div>

                        <a href="{{ route('checkout', $cart->product->slug) }}?size={{ $cart->size }}&qty={{ $cart->quantity }}" class="bg-gray-900 text-white text-[10px] font-black tracking-widest uppercase px-6 py-3 rounded-xl hover:bg-[#9CE300] hover:text-black transition-all shadow-md flex items-center gap-2">
                            <i class="fa-solid fa-credit-card"></i> CHECKOUT
                        </a>

                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-11 h-11 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100" title="Hapus dari Keranjang">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-16 text-center shadow-sm">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i class="fa-solid fa-cart-arrow-down text-4xl text-gray-300"></i>
                    </div>
                    <h2 class="text-2xl font-black italic uppercase text-gray-800">Keranjang Kosong</h2>
                    <p class="text-gray-500 mt-2 mb-8">Yuk, temukan sepatu impianmu dan mulai penuhi keranjang ini!</p>
                    <a href="{{ route('home') }}" class="inline-block bg-[#9CE300] text-black text-xs font-black tracking-widest uppercase px-8 py-4 rounded-xl hover:bg-black hover:text-[#9CE300] transition-all shadow-lg">MULAI BELANJA</a>
                </div>
            @endforelse
        </div>

    </main>

    @include('front.layouts.footer')

</body>
</html>
