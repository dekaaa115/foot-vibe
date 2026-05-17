<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication - FootVibe</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logos/logo.svg') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen flex items-center justify-center relative selection:bg-[#9CE300]">

    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#9CE300]/20 blur-[120px] z-0"></div>

    <div class="relative z-10 w-full max-w-4xl p-6">
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="font-black text-4xl italic tracking-tighter text-gray-900">FOOTVIBE</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white/50 backdrop-blur-xl border border-white/60 p-8 rounded-[2rem] shadow-2xl">

            <div>
                <h2 class="text-2xl font-black italic uppercase tracking-tight mb-6">Login</h2>
                @error('email') <div class="text-red-500 text-xs font-bold mb-4">{{ $message }}</div> @enderror
                <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <input type="email" name="email" placeholder="Email Address" required class="w-full bg-white/60 border border-white/80 px-4 py-3 rounded-xl outline-none focus:border-[#9CE300] transition text-sm">
                    <input type="password" name="password" placeholder="Password" required class="w-full bg-white/60 border border-white/80 px-4 py-3 rounded-xl outline-none focus:border-[#9CE300] transition text-sm">
                    <button type="submit" class="bg-gray-900 text-white font-black py-3 rounded-xl hover:bg-black transition mt-2 shadow-lg">LOGIN</button>
                </form>
            </div>

            <div class="border-t border-gray-200/50 pt-8 md:border-t-0 md:border-l md:pt-0 md:pl-8">
                <h2 class="text-2xl font-black italic uppercase tracking-tight mb-6">Register</h2>
                <form action="{{ route('register.post') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Full Name" required class="w-full bg-white/60 border border-white/80 px-4 py-3 rounded-xl outline-none focus:border-[#9CE300] transition text-sm">
                    <input type="email" name="email" placeholder="Email Address" required class="w-full bg-white/60 border border-white/80 px-4 py-3 rounded-xl outline-none focus:border-[#9CE300] transition text-sm">
                    <input type="password" name="password" placeholder="Password (Min. 8 characters)" required class="w-full bg-white/60 border border-white/80 px-4 py-3 rounded-xl outline-none focus:border-[#9CE300] transition text-sm">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full bg-white/60 border border-white/80 px-4 py-3 rounded-xl outline-none focus:border-[#9CE300] transition text-sm">
                    <button type="submit" class="bg-[#9CE300] text-black font-black py-3 rounded-xl hover:bg-[#8acc00] transition mt-2 shadow-lg">CREATE ACCOUNT</button>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
