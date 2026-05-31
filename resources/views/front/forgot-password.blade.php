<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 text-gray-800 relative min-h-screen flex items-center justify-center selection:bg-[#9CE300] selection:text-black p-4">

    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-400/10 blur-[120px] pointer-events-none z-0"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="text-center mb-8">
            <img src="{{ asset('assets/images/logos/logo.svg') }}?v=2" alt="FootVibe" class="h-16 mx-auto mb-4">
            <h2 class="text-3xl font-black italic uppercase tracking-tight text-gray-900">Reset Password</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Masukkan email akunmu dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 bg-[#9CE300]/20 text-green-800 border border-[#9CE300]/50 rounded-xl text-sm font-bold text-center">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 border border-red-200 rounded-xl text-sm font-bold text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-6">
                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Email Address</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full text-sm font-semibold text-gray-900 bg-white/60 pl-11 pr-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all placeholder-gray-400" placeholder="nama@email.com">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#9CE300] text-black font-black text-sm py-3.5 rounded-xl hover:bg-[#8acc00] hover:scale-[1.02] transition-all shadow-md tracking-wider flex justify-center items-center gap-2">
                    <i class="fa-regular fa-paper-plane"></i> SEND RESET LINK
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-xs font-bold text-gray-500 hover:text-gray-900 transition flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke halaman Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>
