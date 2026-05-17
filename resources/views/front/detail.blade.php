<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300] selection:text-black">
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 w-full max-w-[1000px] mx-auto mt-8 px-4 mb-20">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition mb-6 bg-white/50 px-4 py-2 rounded-xl backdrop-blur-md border border-white/60 w-max shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI
        </a>

        @if(session('success'))
        <div class="mb-6 p-4 bg-[#9CE300] text-black font-bold text-sm rounded-2xl shadow-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-500 text-white font-bold text-sm rounded-2xl shadow-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-exclamation text-lg"></i> {{ $errors->first() }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-16">
            @php
                $allImages = [];
                if($product->image) {
                    $allImages[] = str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image);
                } else {
                    $allImages[] = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80';
                }

                if(is_array($product->images)) {
                    foreach($product->images as $img) {
                        $allImages[] = str_starts_with($img, 'http') ? $img : asset('storage/' . $img);
                    }
                }
            @endphp

            <div class="flex flex-col gap-4">
                <div class="bg-white/50 backdrop-blur-md rounded-3xl p-4 shadow-sm h-[350px] md:h-[400px] flex items-center justify-center border border-white/60">
                    <img id="mainImage" src="{{ $allImages[0] }}" alt="Shoe" class="w-full h-full object-cover rounded-2xl transition-all duration-300">
                </div>

                @if(count($allImages) > 1)
                <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar">
                    @foreach($allImages as $index => $imgSrc)
                    <div onclick="changeImage('{{ $imgSrc }}', this)" class="thumbnail-item w-20 h-20 bg-white/50 backdrop-blur-md rounded-xl p-1.5 cursor-pointer border-2 {{ $index == 0 ? 'border-[#9CE300]' : 'border-transparent' }} hover:border-[#9CE300] transition-all flex-shrink-0 shadow-sm">
                        <img src="{{ $imgSrc }}" class="w-full h-full object-cover rounded-lg">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="flex flex-col justify-center">
                <h1 class="text-4xl font-black italic uppercase tracking-tight text-gray-900">{{ $product->name }}</h1>

                @php
                    $avgRating = $product->reviews->avg('rating') ?? 0;
                    $reviewCount = $product->reviews->count();
                @endphp
                <div class="flex items-center gap-2 mt-2">
                    <div class="flex text-yellow-400 text-sm">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating))
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-xs font-bold text-gray-500">({{ number_format($avgRating, 1) }} / {{ $reviewCount }} Ulasan)</span>
                </div>

                <div class="flex flex-wrap items-baseline gap-3 mt-4">
                    <div class="text-3xl font-black text-[#8acc00]">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @if($product->original_price && $product->original_price > $product->price)
                    <div class="text-base text-gray-400 line-through font-semibold">Rp {{ number_format($product->original_price, 0, ',', '.') }}</div>
                    @endif
                </div>

                <div class="text-gray-500 font-medium mt-6 leading-relaxed text-sm">{!! $product->description ?? 'Tidak ada deskripsi untuk produk ini.' !!}</div>
                <div class="mt-4 text-[11px] font-black tracking-widest text-gray-400 bg-white/60 w-max px-3 py-1.5 rounded-lg border border-white/80">STOCK TERSEDIA: {{ $product->stock }}</div>

                <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="mt-8" id="productForm">
                    @csrf
                    @php
                        $sizesArray = [];
                        if (!empty($product->sizes)) {
                            if (is_array($product->sizes)) {
                                $sizesArray = $product->sizes;
                            } elseif (is_string($product->sizes)) {
                                $decoded = json_decode($product->sizes, true);
                                $sizesArray = is_array($decoded) ? $decoded : explode(',', $product->sizes);
                            }
                        }
                    @endphp

                    @if(count($sizesArray) > 0)
                    <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-3">Pilih Ukuran</label>
                    <div class="flex gap-3 mb-6 flex-wrap">
                        @foreach($sizesArray as $size)
                            @if(trim($size) !== '')
                            <label class="cursor-pointer relative">
                                <input type="radio" name="size" value="{{ trim($size) }}" class="peer absolute opacity-0 w-0 h-0" required>
                                <div class="w-12 h-12 bg-white border border-gray-300 rounded-xl flex items-center justify-center font-bold text-gray-600 peer-checked:bg-[#9CE300] peer-checked:border-[#9CE300] peer-checked:text-black transition shadow-sm hover:border-gray-400">
                                    {{ trim($size) }}
                                </div>
                            </label>
                            @endif
                        @endforeach
                    </div>
                    @endif

                    <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-3">Jumlah (Quantity)</label>
                    <div class="flex items-center gap-4 mb-8">
                        <input type="number" id="qtyInput" name="qty" value="1" min="1" max="{{ $product->stock }}" class="w-24 bg-white px-4 py-3 rounded-xl border border-gray-300 outline-none focus:border-[#9CE300] transition text-center font-bold shadow-sm" required>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-white border-2 border-gray-900 text-gray-900 font-black tracking-widest uppercase py-4 rounded-xl hover:bg-gray-100 transition-all shadow-sm flex items-center justify-center gap-3">
                            <i class="fa-solid fa-cart-plus"></i> KERANJANG
                        </button>

                        <button type="button" onclick="directCheckout()" class="flex-1 bg-gray-900 text-white font-black tracking-widest uppercase py-4 rounded-xl hover:bg-black transition-all shadow-lg flex items-center justify-center gap-3">
                            <i class="fa-solid fa-credit-card"></i> BELI SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-200/60 pt-10">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black italic tracking-tight text-gray-900 uppercase"><i class="fa-solid fa-star-half-stroke text-[#9CE300]"></i> Ulasan Pelanggan</h2>
                <span class="text-xs font-bold text-gray-500 bg-white/60 px-3 py-1.5 rounded-lg border border-white/80">Hanya pembeli yang dapat mengulas</span>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="flex flex-col gap-4 max-h-[600px] overflow-y-auto pr-2 no-scrollbar">
                    @forelse($product->reviews()->latest()->get() as $review)
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl p-5 border border-white/60 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-gray-200 to-gray-100 flex items-center justify-center font-black text-gray-500 border border-white shadow-sm">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-gray-900">{{ $review->user->name }}</h4>
                                    <div class="text-[10px] text-gray-400 font-semibold">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="flex text-yellow-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed font-medium mt-2">"{{ $review->comment }}"</p>

                        @if($review->image)
                        <div class="mt-3">
                            <div class="w-20 h-20 rounded-xl overflow-hidden border border-gray-200 cursor-pointer shadow-sm" onclick="window.open('{{ asset('storage/' . $review->image) }}', '_blank')">
                                <img src="{{ asset('storage/' . $review->image) }}" class="w-full h-full object-cover hover:scale-110 transition duration-300" alt="Foto Ulasan">
                            </div>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-12 bg-white/40 backdrop-blur-sm rounded-3xl border border-white/60 border-dashed">
                        <i class="fa-regular fa-comments text-4xl text-gray-300 mb-3"></i>
                        <h3 class="font-bold text-gray-600">Belum ada ulasan</h3>
                        <p class="text-xs text-gray-400 mt-1">Produk ini belum memiliki ulasan dari pembeli.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    @include('front.layouts.footer')

    <script>
        function changeImage(src, element) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail-item').forEach(el => {
                el.classList.remove('border-[#9CE300]');
                el.classList.add('border-transparent');
            });
            element.classList.remove('border-transparent');
            element.classList.add('border-[#9CE300]');
        }

        function directCheckout() {
            let sizeEl = document.querySelector('input[name="size"]:checked');
            let size = sizeEl ? sizeEl.value : '';
            let qty = document.getElementById('qtyInput').value;

            let hasSizes = document.querySelectorAll('input[name="size"]').length > 0;
            if (hasSizes && !size) {
                alert('Silakan pilih ukuran terlebih dahulu!');
                return;
            }

            window.location.href = "{{ route('checkout', $product->slug) }}?size=" + size + "&qty=" + qty;
        }
    </script>
</body>
</html>
