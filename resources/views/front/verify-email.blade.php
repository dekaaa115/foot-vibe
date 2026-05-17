<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen flex items-center justify-center relative selection:bg-[#9CE300]">

    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] z-0"></div>

    <div class="relative z-10 w-full max-w-md p-6 text-center">
        <div class="bg-white/50 backdrop-blur-xl border border-white/60 p-10 rounded-[2rem] shadow-2xl">
            <h2 class="text-2xl font-black italic uppercase tracking-tight mb-4">Verify Your Email</h2>
            <p class="text-sm text-gray-600 mb-6 font-medium leading-relaxed">
                Terima kasih telah mendaftar! Sebelum memulai, harap verifikasi alamat email kamu dengan mengklik tautan yang baru saja kami kirimkan ke email kamu.
            </p>

            @if (session('message'))
                <div class="mb-6 font-bold text-[11px] text-[#9CE300] bg-gray-900 py-2 px-4 rounded-lg">
                    Tautan verifikasi baru telah dikirim!
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-[#9CE300] text-black font-black py-3 rounded-xl hover:bg-[#8acc00] transition shadow-lg text-sm mb-4">
                    KIRIM ULANG EMAIL VERIFIKASI
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-bold text-gray-400 hover:text-gray-900 transition underline underline-offset-2">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
