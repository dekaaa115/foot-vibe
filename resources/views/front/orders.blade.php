<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300] selection:text-black">

    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 flex-1 w-full max-w-[1200px] mx-auto mt-10 px-4 mb-20">

        <div class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-8 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-800 transition">Home</a>
            <i class="fa-solid fa-angle-right text-[9px]"></i>
            <a href="{{ route('profile') }}" class="hover:text-gray-800 transition">My Profile</a>
            <i class="fa-solid fa-angle-right text-[9px]"></i>
            <span class="text-gray-800">Orders</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

            <div class="md:col-span-4 lg:col-span-3 flex flex-col gap-6">
                <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 text-center shadow-[0_8px_30px_rgba(0,0,0,0.04)] relative group">
                    <div class="w-28 h-28 mx-auto rounded-full bg-gradient-to-br from-gray-800 to-black p-1 shadow-xl mb-5 relative overflow-hidden">
                        <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&q=80' }}" alt="Avatar" class="w-full h-full object-cover rounded-full border-2 border-black/50 bg-white">
                    </div>
                    <h2 class="text-xl font-black italic uppercase tracking-tight text-gray-900 line-clamp-1">{{ $user->name }}</h2>
                    <p class="text-xs text-gray-500 font-medium mt-1 truncate">{{ $user->email }}</p>
                </div>

                <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-4 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                    <ul class="flex flex-col space-y-1">
                        <li>
                            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-white/50 hover:text-gray-900 rounded-2xl font-semibold text-sm transition">
                                <i class="fa-regular fa-user text-gray-400 w-5"></i> Account Details
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders') }}" class="flex items-center gap-3 px-4 py-3 bg-white/70 text-gray-900 rounded-2xl font-bold text-sm transition shadow-sm border border-white/80">
                                <i class="fa-solid fa-bag-shopping text-[#9CE300] w-5"></i> My Orders
                            </a>
                        </li>
                        <li>
                            <button type="button" onclick="alert('Halaman Settings sedang dalam tahap pengembangan.')" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-white/50 hover:text-gray-900 rounded-2xl font-semibold text-sm transition border-b border-gray-200/50 mb-1 pb-4">
                                <i class="fa-solid fa-gear text-gray-400 w-5"></i> Settings
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="pt-1">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 mt-1 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-2xl font-semibold text-sm transition">
                                    <i class="fa-solid fa-arrow-right-from-bracket w-5"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="md:col-span-8 lg:col-span-9 flex flex-col gap-6">

                <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                    <h3 class="text-2xl font-black italic flex items-center gap-2 uppercase tracking-tight text-gray-800 mb-2">
                        Order History
                    </h3>
                    <p class="text-sm font-medium text-gray-500 mb-6">Lacak status pesanan sepatu terbaru kamu di sini.</p>

                    <div class="flex flex-col gap-6">

                        @forelse($orders as $order)
                        <div class="bg-white/60 border border-white/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow group">
                            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 border-b border-gray-200/50 pb-4 mb-4">
                                <div>
                                    <div class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Order ID</div>
                                    <div class="text-sm font-black text-gray-900">{{ $order->order_number }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Date</div>
                                    <div class="text-sm font-semibold text-gray-800">{{ $order->created_at->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Total Amount</div>
                                    <div class="text-sm font-black text-[#8acc00]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>

                                @if($order->status == 'delivered')
                                <div class="bg-[#9CE300]/20 text-green-700 text-[10px] font-black px-3 py-1.5 rounded-lg border border-[#9CE300]/30 flex items-center gap-1.5 self-start sm:self-auto">
                                    <i class="fa-solid fa-check"></i> DELIVERED
                                </div>
                                @elseif($order->status == 'processing')
                                <div class="bg-blue-100 text-blue-700 text-[10px] font-black px-3 py-1.5 rounded-lg border border-blue-200 flex items-center gap-1.5 self-start sm:self-auto">
                                    <i class="fa-solid fa-spinner animate-spin"></i> PROCESSING
                                </div>
                                @else
                                <div class="bg-red-100 text-red-700 text-[10px] font-black px-3 py-1.5 rounded-lg border border-red-200 flex items-center gap-1.5 self-start sm:self-auto">
                                    <i class="fa-solid fa-xmark"></i> CANCELLED
                                </div>
                                @endif
                            </div>

                            @foreach($order->items as $item)
                            <div class="flex gap-4 items-center mb-3 last:mb-0">
                                <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex-shrink-0">
                                    <img src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" alt="Shoe" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-sm md:text-base">{{ $item->product ? $item->product->name : 'Produk Tidak Diketahui' }}</h4>
                                    <div class="text-xs text-gray-500 font-medium mt-1">Size: {{ $item->size ?? '-' }} | Qty: {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            @endforeach

                            <div class="mt-4 pt-4 border-t border-gray-200/50 flex justify-end">
                                <a href="{{ route('order.show', $order->id) }}" class="text-[10px] font-black text-gray-900 tracking-widest uppercase bg-white border border-gray-200 px-4 py-2 rounded-lg hover:bg-[#9CE300] hover:border-[#9CE300] hover:text-black transition">
                                    VIEW DETAILS
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10">
                            <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                            <h4 class="text-lg font-bold text-gray-800">Belum ada pesanan</h4>
                            <p class="text-sm text-gray-500 mt-1">Ayo mulai belanja sepatu favoritmu!</p>
                            <a href="{{ route('home') }}" class="inline-block mt-4 text-[11px] font-black text-black hover:bg-[#8acc00] transition-all uppercase tracking-widest bg-[#9CE300] px-6 py-2.5 rounded-xl shadow-md">
                                MULAI BELANJA
                            </a>
                        </div>
                        @endforelse

                    </div>
                </div>

            </div>
        </div>

    </main>

    @include('front.layouts.footer')

</body>
</html>
