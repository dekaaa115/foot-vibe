<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password - FootVibe</title>
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
            <h2 class="text-3xl font-black italic uppercase tracking-tight text-gray-900">New Password</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Silakan buat kata sandi baru untuk akunmu.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 border border-red-200 rounded-xl text-sm font-bold text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="bg-white/50 backdrop-blur-md border border-white/60 rounded-3xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-5">
                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" readonly class="w-full text-sm font-semibold text-gray-500 bg-gray-100/50 px-4 py-3 rounded-xl border border-white/80 shadow-inner outline-none cursor-not-allowed">
                </div>

                <div class="mb-5">
                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">New Password</label>
                    <input type="password" name="password" required autofocus class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                </div>

                <div class="mb-8">
                    <label class="text-[10px] font-bold text-gray-500 tracking-widest uppercase mb-2 block">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required class="w-full text-sm font-semibold text-gray-900 bg-white/60 px-4 py-3 rounded-xl border border-white/80 shadow-sm outline-none focus:border-[#9CE300] focus:ring-2 focus:ring-[#9CE300]/20 transition-all">
                </div>

                <button type="submit" class="w-full bg-[#9CE300] text-black font-black text-sm py-3.5 rounded-xl hover:bg-[#8acc00] hover:scale-[1.02] transition-all shadow-md tracking-wider flex justify-center items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> SAVE NEW PASSWORD
                </button>
            </form>
        </div>
    </div>

</body>
</html>
