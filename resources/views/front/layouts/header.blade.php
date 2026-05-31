<header class="bg-[#9CE300]/70 backdrop-blur-md py-3 px-6 flex items-center justify-between sticky top-0 z-50 border-b border-white/30 shadow-[0_4px_30px_rgba(0,0,0,0.05)]">
    <div class="flex items-center gap-2 relative z-10">
        <img src="{{ asset('assets/images/logos/logo-b.svg') }}?v=2" alt="FootVibe Logo" class="h-12 w-auto">
        <a href="{{ route('home') }}" class="font-black text-2xl italic tracking-tighter text-gray-900">FootVibe</a>
    </div>

    <div class="flex-1 max-w-3xl mx-8 relative z-10">
        <form action="{{ route('search') }}" method="GET" class="relative w-full">
            <input type="text" name="q" value="{{ request('q') ?? '' }}" placeholder="Search for the latest drops, performance sneakers and more..." class="w-full py-2.5 px-4 rounded-xl shadow-inner bg-white/50 backdrop-blur-sm border border-white/50 outline-none text-sm focus:bg-white/80 transition-all text-gray-800 placeholder-gray-600" required>
            <button type="submit" class="absolute right-0 top-0 bottom-0 bg-gray-900/90 backdrop-blur-sm text-white px-5 rounded-r-xl hover:bg-gray-800 transition">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <div class="flex items-center gap-6 text-gray-900 text-xl relative z-10">
        <a href="https://wa.me/6285175395314?text=Halo%20Admin%20FootVibe,%20saya%20butuh%20bantuan%20terkait%20produk%20sneakers..." class="hover:scale-110 transition-transform duration-200"><i class="fa-solid fa-headset"></i></a>
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
