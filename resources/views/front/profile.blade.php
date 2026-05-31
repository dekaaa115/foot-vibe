<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
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
            <span class="text-gray-800">My Profile</span>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-[#9CE300] text-black font-bold text-sm rounded-2xl shadow-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-500 text-white font-bold text-sm rounded-2xl shadow-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($user)
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

            <div class="md:col-span-4 lg:col-span-3 flex flex-col gap-6">

                <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 text-center shadow-[0_8px_30px_rgba(0,0,0,0.04)] relative group">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                        @csrf
                        @method('PUT')
                        <div class="w-28 h-28 mx-auto rounded-full bg-gradient-to-br from-gray-800 to-black p-1 shadow-xl mb-5 relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                            <img id="preview_image" src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&q=80' }}" alt="Avatar" class="w-full h-full object-cover rounded-full border-2 border-black/50 bg-white">
                            <label for="profile_photo" class="absolute inset-0 bg-black/70 flex flex-col items-center justify-center text-white text-[10px] font-black tracking-widest opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer rounded-full">
                                <i class="fa-solid fa-camera text-xl mb-1.5 text-[#9CE300]"></i>
                                CHANGE
                            </label>
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*" onchange="submitAvatar(this)">
                        </div>
                    </form>

                    <h2 class="text-xl font-black italic uppercase tracking-tight text-gray-900 line-clamp-1">{{ $user->name }}</h2>
                    <p class="text-xs text-gray-500 font-medium mt-1 truncate">{{ $user->email }}</p>
                </div>

                <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-4 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                    <ul class="flex flex-col space-y-1">
                        <li>
                            <button onclick="switchTab('account-details')" id="btn-account-details" class="tab-btn w-full flex items-center gap-3 px-4 py-3 bg-white/70 text-gray-900 rounded-2xl font-bold text-sm transition shadow-sm border border-white/80">
                                <i class="fa-regular fa-user text-[#9CE300] w-5"></i> Account Details
                            </button>
                        </li>
                        <li>
                            <a href="{{ route('orders') }}" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-white/50 hover:text-gray-900 rounded-2xl font-semibold text-sm transition">
                                <i class="fa-solid fa-bag-shopping text-gray-400 w-5"></i> My Orders
                            </a>
                        </li>
                        <li>
                            <button onclick="switchTab('settings')" id="btn-settings" class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-white/50 hover:text-gray-900 rounded-2xl font-semibold text-sm transition border-b border-gray-200/50 mb-1 pb-4">
                                <i class="fa-solid fa-gear text-gray-400 w-5"></i> Settings
                            </button>
                        </li>
                        <li>
                            <button type="button" onclick="document.getElementById('logout-form').submit();" class="w-full flex items-center gap-3 px-4 py-3 mt-1 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-2xl font-semibold text-sm transition">
                                <i class="fa-solid fa-arrow-right-from-bracket w-5"></i> Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="md:col-span-8 lg:col-span-9 flex flex-col gap-8">

                <div id="tab-account-details" class="tab-content active">
                    <form action="{{ route('profile.update') }}" method="POST" class="flex flex-col gap-8">
                        @csrf
                        @method('PUT')

                        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                            <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b border-gray-200/50 pb-4 gap-4">
                                <h3 class="text-xl font-black italic flex items-center gap-2 uppercase tracking-tight text-gray-800">
                                    <div class="bg-[#9CE300] p-1.5 rounded-lg shadow-sm"><i class="fa-regular fa-id-card text-black text-sm"></i></div> Profile Info
                                </h3>
                                <button type="submit" class="text-[11px] font-black text-black hover:bg-black hover:text-[#9CE300] transition-all uppercase tracking-widest bg-[#9CE300] px-6 py-2.5 rounded-xl shadow-lg border border-transparent hover:border-[#9CE300]/50 w-full md:w-auto">
                                    SAVE CHANGES
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Email Address (Read-Only)</label>
                                    <input type="email" value="{{ $user->email }}" disabled class="w-full text-sm font-semibold text-gray-400 bg-gray-100/40 px-4 py-3 rounded-xl border border-white/50 shadow-inner cursor-not-allowed outline-none">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Phone Number</label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="e.g. +62 812-3456-7890" class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Date of Birth</label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                            <div class="flex justify-between items-center mb-6 border-b border-gray-200/50 pb-4">
                                <h3 class="text-xl font-black italic flex items-center gap-2 uppercase tracking-tight text-gray-800">
                                    <div class="bg-[#9CE300] p-1.5 rounded-lg shadow-sm"><i class="fa-solid fa-truck-fast text-black text-sm"></i></div> Delivery Address
                                </h3>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Full Address</label>
                                <textarea name="address" rows="4" placeholder="Ketik alamat lengkap pengiriman kamu di sini (Jalan, RT/RW, Kecamatan, Kode Pos)..." class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all resize-y">{{ old('address', $user->address) }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tab-settings" class="tab-content">
                    <form action="{{ route('profile.password.update') }}" method="POST" class="flex flex-col gap-8">
                        @csrf
                        @method('PUT')

                        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                            <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b border-gray-200/50 pb-4 gap-4">
                                <h3 class="text-xl font-black italic flex items-center gap-2 uppercase tracking-tight text-gray-800">
                                    <div class="bg-[#9CE300] p-1.5 rounded-lg shadow-sm"><i class="fa-solid fa-shield-halved text-black text-sm"></i></div> Password & Security
                                </h3>
                                <button type="submit" class="text-[11px] font-black text-white hover:bg-[#9CE300] hover:text-black transition-all uppercase tracking-widest bg-gray-900 px-6 py-2.5 rounded-xl shadow-lg border border-transparent w-full md:w-auto">
                                    UPDATE PASSWORD
                                </button>
                            </div>

                            <div class="flex flex-col gap-5 max-w-xl">
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase block">Current Password</label>
                                        <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-[#9CE300] hover:text-[#8acc00] transition-colors underline underline-offset-2">Lupa sandi saat ini?</a>
                                    </div>
                                    <input type="password" name="current_password" required class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                                </div>
                                <div class="h-[1px] bg-gray-200/50 my-2"></div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">New Password</label>
                                    <input type="password" name="password" required class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" required class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

        @else
        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-12 shadow-[0_8px_30px_rgba(0,0,0,0.04)] flex flex-col items-center justify-center text-center h-full min-h-[400px]">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-6 shadow-inner">
                <i class="fa-solid fa-lock text-3xl text-gray-300"></i>
            </div>
            <h2 class="text-2xl font-black italic uppercase tracking-tight text-gray-900 mb-2">Unlock Your FootVibe</h2>
            <p class="text-gray-500 font-medium mb-8 max-w-md">Login or register to access your account details, track orders, and manage your wishlist.</p>

            <div class="flex flex-col sm:flex-row gap-4 w-full max-w-sm">
                <a href="{{ route('login') }}" class="flex-1 bg-[#9CE300]/90 backdrop-blur-md text-black font-black text-sm py-4 rounded-xl hover:bg-[#9CE300] hover:scale-105 transition-all duration-300 shadow-[0_8px_20px_rgba(156,227,0,0.3)] flex justify-center items-center gap-2 tracking-wider">
                    <i class="fa-solid fa-right-to-bracket text-lg"></i> LOGIN / REGISTER
                </a>
            </div>
        </div>
        @endif

    </main>

    @include('front.layouts.footer')

    <script>
        function switchTab(tabId) {
            // 1. Sembunyikan semua tab content
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            // 2. Tampilkan tab yang dipilih
            document.getElementById('tab-' + tabId).classList.add('active');

            // 3. Reset gaya SEMUA tombol navigasi ke mode "Pasif" (abu-abu)
            document.querySelectorAll('.tab-btn').forEach(btn => {
                // Hapus class penanda aktif
                btn.classList.remove('bg-white/70', 'text-gray-900', 'font-bold', 'shadow-sm', 'border', 'border-white/80');
                // Kembalikan class pasif
                btn.classList.add('text-gray-500', 'font-semibold');

                // Matikan warna hijau pada ikon, ubah jadi abu-abu
                let icon = btn.querySelector('i');
                if(icon) {
                    icon.classList.remove('text-[#9CE300]');
                    icon.classList.add('text-gray-400');
                }
            });

            // 4. Terapkan gaya AKTIF pada tombol yang sedang diklik
            const activeBtn = document.getElementById('btn-' + tabId);

            // Hapus class pasif pada tombol yang diklik
            activeBtn.classList.remove('text-gray-500', 'font-semibold');
            // Tambahkan class aktif (menonjol)
            activeBtn.classList.add('bg-white/70', 'text-gray-900', 'font-bold', 'shadow-sm', 'border', 'border-white/80');

            // Nyalakan warna ikon menjadi hijau neon FootVibe
            let activeIcon = activeBtn.querySelector('i');
            if(activeIcon) {
                activeIcon.classList.remove('text-gray-400');
                activeIcon.classList.add('text-[#9CE300]');
            }
        }

        // Fitur Submit Foto Otomatis
        function submitAvatar(input) {
            if (input.files && input.files[0]) {
                document.getElementById('preview_image').src = window.URL.createObjectURL(input.files[0]);
                document.getElementById('avatarForm').submit();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            // Jika ada kata '?tab=settings' di URL browser, langsung buka tab settings
            if (tab === 'settings') {
                switchTab('settings');
            }
        });
    </script>
</body>
</html>
