<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootVibe - Evolution of Streetwear</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 20s linear infinite;
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300] selection:text-black">

    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 flex-1">

        @if($errors->any())
        <div class="max-w-[1200px] mx-auto mt-6 px-4">
            <div class="p-4 bg-red-500 text-white font-bold text-sm rounded-2xl shadow-sm">
                {{ $errors->first() }}
            </div>
        </div>
        @endif

        <section class="max-w-[1200px] mx-auto mt-8 px-4 reveal active">
            <div class="relative bg-black rounded-3xl overflow-hidden h-[450px] shadow-2xl border border-white/20 group">

                <div id="heroSlider" class="absolute inset-0 w-full h-full">
                    <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?auto=format&fit=crop&q=80" class="hero-slide absolute inset-0 w-full h-full object-cover opacity-50 transition-opacity duration-1000">

                    <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&q=80" class="hero-slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000">

                    <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&q=80" class="hero-slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000">
                </div>

                <div class="absolute inset-0 flex flex-col justify-center p-12 w-[80%] md:w-[60%] z-10 pointer-events-none">
                    <span class="bg-[#9CE300]/90 backdrop-blur-sm text-[10px] font-black px-3 py-1 inline-block w-max mb-4 rounded-md tracking-wider shadow-sm">SEASONAL EXCLUSIVE</span>
                    <h1 class="text-white text-5xl md:text-6xl font-black italic uppercase leading-none tracking-tight drop-shadow-lg">
                        Evolution Of<br>
                        <span class="text-[#9CE300]">Streetwear</span>
                    </h1>
                    <p class="text-gray-200 mt-4 text-sm max-w-sm font-medium drop-shadow-md">
                        Discover the latest performance silhouettes designed for the modern explorer.
                    </p>
                    <button class="bg-[#9CE300]/90 backdrop-blur-md text-black font-black text-sm py-3 px-8 mt-8 w-max rounded-xl hover:bg-[#9CE300] hover:scale-105 transition-all duration-300 shadow-[0_8px_20px_rgba(156,227,0,0.3)] pointer-events-auto">
                        SHOP NOW
                    </button>
                </div>

                <div class="absolute bottom-6 left-12 flex gap-2 z-10">
                    <div class="slide-indicator w-8 h-1.5 rounded-full bg-[#9CE300] transition-all duration-500"></div>
                    <div class="slide-indicator w-3 h-1.5 rounded-full bg-white/40 transition-all duration-500"></div>
                    <div class="slide-indicator w-3 h-1.5 rounded-full bg-white/40 transition-all duration-500"></div>
                </div>
            </div>
        </section>

        <section class="max-w-[1200px] mx-auto mt-14 px-4 reveal">
            <h2 class="text-gray-500 text-xs font-black tracking-widest mb-8 uppercase flex items-center gap-2">
                <div class="h-1 w-1 bg-[#9CE300] rounded-full"></div> Explore Categories
            </h2>

            <div class="flex flex-wrap justify-center gap-6 sm:gap-8 lg:gap-10">
                @forelse($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="flex flex-col items-center gap-3 group w-[80px] sm:w-[100px]">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white/50 backdrop-blur-md rounded-full overflow-hidden flex items-center justify-center border-[3px] border-white/80 shadow-[0_4px_15px_rgba(0,0,0,0.05)] group-hover:shadow-[0_10px_25px_rgba(156,227,0,0.3)] group-hover:-translate-y-2 group-hover:border-[#9CE300] transition-all duration-300 p-1">
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" alt="{{ $category->name }}" class="w-full h-full object-cover rounded-full">
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-gray-500 group-hover:text-gray-900 transition-colors text-center w-full truncate">{{ $category->name }}</span>
                </a>
                @empty
                <div class="w-full text-center py-4 text-xs font-bold text-gray-400">
                    Belum ada kategori yang ditambahkan.
                </div>
                @endforelse
            </div>
        </section>

        <section class="max-w-[1200px] mx-auto mt-16 px-4 reveal">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-black italic flex items-center gap-3 uppercase tracking-tight text-gray-800">
                    <div class="bg-[#9CE300] p-1.5 rounded-lg shadow-sm"><i class="fa-solid fa-arrow-trend-up text-black"></i></div> Popular Products
                </h2>
                <a href="{{ route('products.popular') }}" class="text-[11px] text-gray-500 font-bold hover:text-gray-900 transition flex items-center gap-1 bg-white/40 backdrop-blur-sm px-3 py-1.5 rounded-full border border-white/60 hover:shadow-[0_0_30px_rgba(156,227,0,0.4)]">
                    SEE ALL <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>

            <div class="flex overflow-x-auto gap-5 pb-5 no-scrollbar snap-x scroll-smooth">
                @forelse($popularProducts as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="flex-shrink-0 w-[70%] sm:w-[45%] md:w-[23%] bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-3 relative hover:shadow-[0_0_30px_rgba(156,227,0,0.4)] hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between snap-start block">
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
                            <div class="w-full bg-gray-200/50 h-1.5 mt-3 rounded-full overflow-hidden backdrop-blur-sm">
                                <div class="bg-[#9CE300] h-full rounded-full" style="{{ $product->stock < 5 ? 'width: 20%; background-color: #ef4444;' : 'width: 75%;' }}"></div>
                            </div>

                            @php
                                $avgRating = $product->reviews->avg('rating') ?: 0;
                                $reviewCount = $product->reviews->count();
                            @endphp
                            <div class="text-[10px] font-bold text-gray-500 mt-2 flex justify-between items-center">
                                <span>STOCK: {{ $product->stock }}</span>
                                <span class="flex items-center gap-1 text-gray-600">
                                    <i class="fa-solid fa-star text-yellow-400"></i> {{ number_format($avgRating, 1) }}
                                    <span class="text-gray-400">({{ $reviewCount }})</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="w-full text-center text-sm font-semibold text-gray-400 py-10">Belum ada produk populer.</div>
                @endforelse
            </div>
        </section>

        <section class="max-w-[1200px] mx-auto mt-20 px-4 reveal">
        <h2 class="text-center text-xs font-black tracking-widest text-gray-400 mb-8 uppercase">Authentic Brands We Carry</h2>
            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-20 opacity-60">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="Nike" class="h-6 md:h-8 grayscale hover:grayscale-0 transition-all duration-300 hover:scale-110 cursor-pointer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg" alt="Adidas" class="h-8 md:h-10 grayscale hover:grayscale-0 transition-all duration-300 hover:scale-110 cursor-pointer">
                <img src="https://www.logo.wine/a/logo/Puma_(brand)/Puma_(brand)-Logo.wine.svg" alt="New Balance" class="h-14 md:h-14 grayscale hover:grayscale-0 transition-all duration-300 hover:scale-110 cursor-pointer">
                <img src="https://upload.wikimedia.org/wikipedia/en/3/37/Jumpman_logo.svg" alt="Jordan" class="h-8 md:h-10 grayscale hover:grayscale-0 transition-all duration-300 hover:scale-110 cursor-pointer">
            </div>
        </section>

        <section class="max-w-[1200px] mx-auto mt-20 px-4 pb-20 reveal">
            <div class="flex items-center justify-center gap-6 mb-10">
                <div class="h-[1px] bg-gradient-to-r from-transparent via-gray-300 to-transparent flex-1"></div>
                <h2 class="text-2xl font-black italic flex items-center gap-2 uppercase tracking-tight text-gray-800">
                    <i class="fa-solid fa-asterisk text-[#9CE300]"></i> Daily Discovery
                </h2>
                <div class="h-[1px] bg-gradient-to-r from-transparent via-gray-300 to-transparent flex-1"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 gap-6" id="productGrid">
                @forelse($dailyDiscovery as $index => $product)
                <a href="{{ route('product.show', $product->slug) }}" class="daily-item {{ $index >= 6 ? 'hidden opacity-0' : 'opacity-100' }} bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl hover:shadow-[0_0_30px_rgba(156,227,0,0.4)] hover:-translate-y-1 transition-all duration-500 flex flex-col h-full overflow-hidden group block">
                    <div class="bg-[#F4F4F4]/50 h-64 relative flex items-center justify-center overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?auto=format&fit=crop&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base font-bold text-gray-800 line-clamp-2 leading-tight">{{ $product->name }}</h3>
                            <div class="flex justify-between items-end mt-4">
                                <div class="flex flex-col">
                                    @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-xs text-gray-400 line-through font-medium mb-0.5">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                    @endif
                                    <span class="font-black text-2xl text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                <span class="text-[11px] font-bold text-gray-500 bg-white/60 px-2 py-1 rounded-md">Stock: {{ $product->stock }}</span>
                            </div>
                        </div>

                        @php
                            $avgRating = $product->reviews->avg('rating') ?: 0;
                            $reviewCount = $product->reviews->count();
                        @endphp
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-200/50 text-xs text-gray-500 font-semibold mb-2">
                            <span class="flex items-center gap-1.5 text-gray-700">
                                <i class="fa-solid fa-star text-yellow-400"></i> {{ number_format($avgRating, 1) }}
                                <span class="text-[10px] text-gray-400 font-normal">({{ $reviewCount }} Ulasan)</span>
                            </span>
                            <span>Indonesia</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-3 text-center text-sm font-semibold text-gray-400 py-10">Belum ada produk yang ditambahkan.</div>
                @endforelse
            </div>

            @if(count($dailyDiscovery) > 6)
            <div class="flex justify-center mt-12" id="seeMoreContainer">
                <button type="button" onclick="loadMoreProducts()" id="seeMoreBtn" class="bg-gray-900 text-white text-xs font-black tracking-widest uppercase px-10 py-4 rounded-xl hover:bg-[#9CE300] hover:text-black transition-all shadow-lg flex items-center gap-2">
                    SEE MORE <i class="fa-solid fa-angle-down"></i>
                </button>
            </div>
            @endif
        </section>

        <div class="w-full bg-[#9CE300] text-black py-3 mt-8 overflow-hidden flex whitespace-nowrap border-y border-gray-900 shadow-sm relative z-10">
            <div class="animate-marquee font-black text-sm uppercase tracking-widest flex gap-10 items-center">
                <span><i class="fa-solid fa-bolt"></i> 100% ORIGINAL GUARANTEED</span>
                <span><i class="fa-solid fa-fire"></i> FREE SHIPPING NATIONWIDE</span>
                <span><i class="fa-solid fa-star"></i> NEW SEASONAL DROPS</span>
                <span><i class="fa-solid fa-bolt"></i> 100% ORIGINAL GUARANTEED</span>
                <span><i class="fa-solid fa-fire"></i> FREE SHIPPING NATIONWIDE</span>
                <span><i class="fa-solid fa-star"></i> NEW SEASONAL DROPS</span>
            </div>
        </div>
    </main>

    @include('front.layouts.footer')

    <script>
        // Fungsi Load More (Tersisip dari kode sebelumnya)
        function loadMoreProducts() {
            let hiddenProducts = document.querySelectorAll('.daily-item.hidden');
            let batchSize = 6;
            let count = 0;

            for (let i = 0; i < hiddenProducts.length; i++) {
                if (count < batchSize) {
                    hiddenProducts[i].classList.remove('hidden');
                    setTimeout((element) => {
                        element.classList.remove('opacity-0');
                        element.classList.add('opacity-100');
                    }, 50, hiddenProducts[i]);
                    count++;
                } else {
                    break;
                }
            }

            hiddenProducts = document.querySelectorAll('.daily-item.hidden');
            if (hiddenProducts.length === 0) {
                document.getElementById('seeMoreContainer').style.display = 'none';
            }
        }

        // LOGIKA SLIDER OTOMATIS (Diperbarui dengan Gambar Gahar)
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const indicators = document.querySelectorAll('.slide-indicator');

        function nextSlide() {
            // Sembunyikan slide aktif saat ini
            slides[currentSlide].classList.remove('opacity-50');
            slides[currentSlide].classList.add('opacity-0');
            // Reset indikator aktif
            indicators[currentSlide].classList.remove('w-8', 'bg-[#9CE300]');
            indicators[currentSlide].classList.add('w-3', 'bg-white/40');

            // Hitung index slide berikutnya
            currentSlide = (currentSlide + 1) % slides.length;

            // Tampilkan slide berikutnya
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-50');
            // Set indikator berikutnya menjadi aktif
            indicators[currentSlide].classList.remove('w-3', 'bg-white/40');
            indicators[currentSlide].classList.add('w-8', 'bg-[#9CE300]');
        }

        // Jalankan slider otomatis setiap 4 detik (4000ms)
        setInterval(nextSlide, 4000);

        // FUNGSI REVEAL ON SCROLL (Animasi Modern)
        function revealSections() {
            let reveals = document.querySelectorAll(".reveal");
            for (let i = 0; i < reveals.length; i++) {
                let windowHeight = window.innerHeight;
                let elementTop = reveals[i].getBoundingClientRect().top;
                let elementVisible = 100; // Elemen muncul saat 100px terlihat di layar

                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }

        // Jalankan fungsi saat scroll dan saat halaman dimuat
        window.addEventListener("scroll", revealSections);
        revealSections(); // Memicu pengecekan awal saat halaman loading
    </script>
</body>
</html>
