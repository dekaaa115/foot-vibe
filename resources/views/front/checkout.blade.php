<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex flex-col selection:bg-[#9CE300]">
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>

    @include('front.layouts.header')

    <main class="relative z-10 w-full max-w-[800px] mx-auto mt-8 px-4 mb-20">

        <a href="{{ route('product.show', $product->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition mb-6 bg-white/50 px-4 py-2 rounded-xl backdrop-blur-md border border-white/60 w-max shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI
        </a>

        @if($errors->has('error'))
        <div class="mb-6 p-4 bg-red-500 text-white font-bold text-sm rounded-2xl shadow-sm">
            {{ $errors->first('error') }}
        </div>
        @endif

        <form action="{{ route('order.store', $product->slug) }}" method="POST" enctype="multipart/form-data" class="bg-white/50 backdrop-blur-md rounded-3xl p-8 shadow-sm border border-white/60">
            @csrf
            <input type="hidden" name="size" value="{{ $size }}">
            <input type="hidden" name="qty" value="{{ $qty }}">
            @if($voucher_status == 'success')
                <input type="hidden" name="voucher_code" value="{{ $voucher_code }}">
            @endif

            <h2 class="text-xl font-black italic uppercase tracking-tight text-gray-900 mb-6 border-b border-gray-200/50 pb-4">Order Summary</h2>
            <div class="flex flex-col md:flex-row items-center gap-6 mb-6 bg-white/60 p-4 rounded-2xl border border-white/80">
                <div class="w-24 h-24 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 shrink-0">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80' }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 w-full">
                    <h3 class="font-bold text-gray-900">{{ $product->name }}</h3>
                    <div class="text-sm text-gray-500 mt-1">Size: {{ $size ?? '-' }} | Qty: {{ $qty }}x</div>
                    <div class="text-lg font-black text-[#8acc00] mt-1">Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs text-gray-400 font-medium">/ item</span></div>
                </div>
            </div>

            <div class="bg-white/80 rounded-2xl p-5 mb-8 border border-white shadow-inner">
                <div class="flex justify-between items-center mb-3 text-sm font-semibold text-gray-600">
                    <span>Subtotal Produk ({{ $qty }} item)</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center mb-3 text-sm font-semibold text-gray-600">
                    <span>Ongkos Kirim</span>
                    <span>Rp {{ number_format($shipping_cost, 0, ',', '.') }}</span>
                </div>
                @if($discount > 0)
                <div class="flex justify-between items-center mb-3 text-sm font-bold text-red-500">
                    <span>Diskon Voucher</span>
                    <span>- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="border-t border-gray-200 my-3 pt-3 flex justify-between items-center">
                    <span class="font-black text-gray-900">TOTAL PEMBAYARAN</span>
                    <span class="font-black text-2xl text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            <h2 class="text-xl font-black italic uppercase tracking-tight text-gray-900 mb-6 border-b border-gray-200/50 pb-4">Delivery Address</h2>
            <div class="mb-8 relative">
                <textarea disabled class="w-full bg-gray-100/50 px-4 py-3 rounded-xl border border-white/80 outline-none text-sm font-semibold text-gray-600 resize-none h-24">{{ Auth::user()->address ?? 'Alamat belum diisi. Silakan isi alamat di halaman Profil kamu terlebih dahulu.' }}</textarea>
                <a href="{{ route('profile') }}" class="text-[10px] text-blue-600 font-bold hover:underline mt-1 block"><i class="fa-solid fa-pen-to-square"></i> Ubah di Profil</a>
            </div>

            <h2 class="text-xl font-black italic uppercase tracking-tight text-gray-900 mb-6 border-b border-gray-200/50 pb-4">Payment & Voucher</h2>

            <div class="mb-6 relative">
                <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-2">Kode Voucher (Opsional)</label>
                <div class="flex gap-2">
                    <input type="text" id="voucher_input" value="{{ $voucher_code }}" placeholder="Masukkan kode voucher..." class="w-full bg-white/60 px-4 py-3 rounded-xl border border-white/80 outline-none focus:border-[#9CE300] transition text-sm font-bold uppercase">
                    <button type="button" onclick="applyVoucher()" class="bg-gray-900 text-white font-bold px-6 rounded-xl hover:bg-black transition text-xs tracking-widest">APPLY</button>
                </div>

                @if($voucher_msg)
                    <p class="text-xs font-bold mt-2 flex items-center gap-1 {{ $voucher_status == 'success' ? 'text-green-600' : 'text-red-500' }}">
                        <i class="fa-solid {{ $voucher_status == 'success' ? 'fa-circle-check' : 'fa-circle-exclamation' }}"></i> {{ $voucher_msg }}
                    </p>
                @endif
            </div>

            <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl mb-6">
                <p class="text-sm font-semibold text-blue-900 mb-3">Silakan transfer total pembayaran ke salah satu rekening berikut:</p>
                <ul class="text-sm text-blue-800 font-medium space-y-2">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-building-columns w-5"></i> <strong>BCA:</strong> 1234567890 a.n. FootVibe Official</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-building-columns w-5"></i> <strong>BSI:</strong> 0987654321 a.n. FootVibe Official</li>
                </ul>
            </div>

            <div class="mb-8">
                <label class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mb-2">Upload Bukti Transfer</label>
                <input type="file" name="proof_of_payment" accept="image/*" required class="w-full bg-white/60 px-4 py-3 rounded-xl border border-white/80 outline-none focus:border-[#9CE300] transition text-sm">
            </div>

            <button type="submit" class="w-full bg-[#9CE300] text-black font-black tracking-widest uppercase py-4 rounded-xl hover:bg-[#8acc00] transition-all shadow-lg flex items-center justify-center gap-3">
                <i class="fa-solid fa-paper-plane"></i> SUBMIT PAYMENT
            </button>
        </form>
    </main>

    @include('front.layouts.footer')

    <script>
        function applyVoucher() {
            let code = document.getElementById('voucher_input').value;
            let url = new URL(window.location.href);
            url.searchParams.set('voucher', code);
            window.location.href = url.href;
        }
    </script>
</body>
</html>
