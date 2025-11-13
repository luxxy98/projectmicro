<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Masuk - SiberLogin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0F1E33] via-[#2B4F7D] to-[#7EA2CC] p-4">

    <div class="w-full max-w-md rounded-2xl bg-white/90 backdrop-blur shadow-2xl p-6 md:p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-slate-900">Masuk ke <span class="text-[#2B4F7D]">SiberLogin</span></h1>
            <p class="text-sm text-slate-500 mt-1">Gunakan email dan kata sandi Anda</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       


        {{-- FORM --}}
        <form method="POST" action="{{ url('/login') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input name="email" type="email" value="{{ old('email') }}"
                required autocomplete="username" placeholder="user@mail.com"
                class="w-full rounded-lg border border-slate-300 px-3 py-2
         focus:outline-none focus:ring-2 focus:ring-[#2B4F7D] focus:border-transparent
         placeholder:text-slate-400">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror



            {{-- Password + eye --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 pr-10
                   focus:outline-none focus:ring-2 focus:ring-[#2B4F7D] focus:border-transparent
                   placeholder:text-slate-400">
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-500 hover:text-slate-700"
                        aria-label="Tampilkan sandi" aria-pressed="false" title="Tampilkan sandi">
                        {{-- eye --}}
                        <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                            <path fill="none" stroke="currentColor" stroke-width="2"
                                d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" />
                            <circle cx="12" cy="12" r="3" fill="none" stroke="currentColor"
                                stroke-width="2" />
                        </svg>
                        {{-- eye-off --}}
                        <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="h-5 w-5 hidden">
                            <path fill="none" stroke="currentColor" stroke-width="2"
                                d="M3 3l18 18M10.6 10.6a3 3 0 104.24 4.24M9.88 4.26A11.6 11.6 0 0112 5c7 0 11 7 11 7a19.8 19.8 0 01-4.17 4.9M6.1 6.1A19.8 19.8 0 001 12s4 7 11 7a11.6 11.6 0 004.1-.74" />
                        </svg>
                    </button>
                </div>

                {{-- link kecil, rata kanan, tepat di bawah kolom password --}}
                <div class="mt-1 w-full text-right leading-tight">
                    <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline">Lupa
                        Password?</a>
                </div>
            </div>

            {{-- reCAPTCHA (opsional saat needsCaptcha=true) --}}
            @if (!empty($needsCaptcha ?? false))
                <div class="mt-1">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    @error('g-recaptcha-response')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            {{-- Tombol login --}}
            <button type="submit"
                class="w-full text-white py-2.5 rounded-lg shadow
               bg-gradient-to-r from-[#0F1E33] via-[#2B4F7D] to-[#7EA2CC]
               hover:from-[#0C192A] hover:via-[#254570] hover:to-[#6E92BC]
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2B4F7D]">
                Login
            </button>

            <p class="text-center text-sm text-slate-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-[#2B4F7D] hover:underline">Daftar</a>
            </p>
        </form>
        {{-- /FORM --}}
    </div>

    <script>
        const pwd = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        const eye = document.getElementById('icon-eye');
        const off = document.getElementById('icon-eye-off');
        btn.addEventListener('click', () => {
            const show = pwd.type === 'password';
            pwd.type = show ? 'text' : 'password';
            eye.classList.toggle('hidden', !show);
            off.classList.toggle('hidden', show);
            btn.setAttribute('aria-pressed', String(show));
            btn.title = show ? 'Sembunyikan sandi' : 'Tampilkan sandi';
        });
    </script>
</body>

</html>
