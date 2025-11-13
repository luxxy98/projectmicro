<!doctype html>
<html lang="id">

<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Daftar - SiberLogin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Montserrat, sans-serif;
            background: linear-gradient(135deg, #010D26 0%, #1a2b4a 30%, #4a6fa5 70%, #C9DFF2 100%);
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            min-height: 100vh;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-bottom: 15px;
        }

        .login-card h2 {
            color: #1D64F2;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .login-card p {
            font-size: 14px;
            color: #4a6fa5;
            margin-bottom: 25px;
        }

        .login-card label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 13px;
            color: #010D26;
            font-weight: 500;
        }

        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 93%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .login-card input[type="email"]:focus,
        .login-card input[type="password"]:focus {
            outline: none;
            border-color: #1D64F2;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 3px rgba(29, 100, 242, 0.1);
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 20px;
            color: #1D64F2;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #010D26;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .alert-error {
            background: rgba(248, 215, 218, 0.9);
            color: #721c24;
            border-color: rgba(220, 53, 69, 0.3);
        }

        .alert-success {
            background: rgba(212, 237, 218, 0.9);
            color: #155724;
            border-color: rgba(40, 167, 69, 0.3);
        }

        .login-card button {
            width: 100%;
            background: linear-gradient(135deg, #1D64F2 0%, #010D26 100%);
            color: white;
            border: none;
            padding: 14px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(29, 100, 242, 0.3);
        }

        .login-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(29, 100, 242, 0.4);
        }

        .login-card button:active {
            transform: translateY(0);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <form method="POST" action="{{ url('/register') }}" class="w-full max-w-sm bg-white p-6 rounded-xl shadow">
        @csrf
        <h1 class="text-xl font-semibold mb-4">Buat Akun</h1>

        @if ($errors->any())
            <div class="mb-3 text-red-600 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
        <input name="name" type="text" value="{{ old('name') }}" required minlength="4" maxlength="255"
            class="w-full rounded-lg border px-3 py-2" placeholder="">

        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        {{-- Username --}}
        <div class="mt-3">
            <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
            <input name="username" type="text" value="{{ old('username') }}" required minlength="4" maxlength="20"
                pattern="^[A-Za-z][A-Za-z0-9_]*$"
                class="w-full rounded-lg border px-3 py-2
           focus:outline-none focus:ring-2 focus:ring-[#2B4F7D] focus:border-transparent"
                placeholder="">
            <p class="mt-1 text-xs text-slate-500">
                4–20 karakter, diawali huruf, hanya huruf/angka/underscore, tanpa “__”.
            </p>
            @error('username')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>


        {{-- Nomor Telepon (Indonesia) --}}
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required inputmode="numeric"
                pattern="[0-9]*" maxlength="14" {{-- Indonesia: maksimal 13 digit untuk pola 08xxxxxxxxxxx --}}
                class="w-full rounded-lg border border-slate-300 px-3 py-2
           focus:outline-none focus:ring-2 focus:ring-[#2B4F7D] focus:border-transparent
           placeholder:text-slate-400">
            @error('phone')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>


        <label class="block mb-2 text-sm">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required
            class="w-full border rounded p-2 mb-4" />

        <label class="block mb-2 text-sm">Password</label>
        <div class="relative mb-4">
            <input id="password" name="password" type="password" required class="w-full border rounded p-2 pr-10" />
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center"
                title="Tampilkan sandi">
                <!-- eye -->
                <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-5 w-5 text-gray-600 hover:text-gray-900">
                    <path fill="none" stroke="currentColor" stroke-width="2"
                        d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" />
                    <circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="2" />
                </svg>
                <!-- eye-off -->
                <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-5 w-5 text-gray-600 hover:text-gray-900 hidden">
                    <path fill="none" stroke="currentColor" stroke-width="2"
                        d="M3 3l18 18M10.6 10.6a3 3 0 104.24 4.24M9.88 4.26A11.6 11.6 0 0112 5c7 0 11 7 11 7a19.8 19.8 0 01-4.17 4.9M6.1 6.1A19.8 19.8 0 001 12s4 7 11 7a11.6 11.6 0 004.1-.74" />
                </svg>
            </button>
        </div>

        <label class="block mb-2 text-sm">Konfirmasi Password</label>
        <input name="password_confirmation" type="password" required class="w-full border rounded p-2 mb-4" />

        {{-- Optional terms --}}
        <label class="inline-flex items-center mb-4">
            <input type="checkbox" name="accept_terms" class="mr-2">
            <span class="text-sm">Saya setuju dengan ketentuan.</span>
        </label>

        <div class="g-recaptcha mb-4" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>


        <button type="submit"
            class="w-full text-white py-2 rounded shadow
         bg-gradient-to-r from-[#0F1E33] via-[#2B4F7D] to-[#7EA2CC]
         hover:from-[#0C192A] hover:via-[#254570] hover:to-[#6E92BC]
         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2B4F7D]">
            Daftar
        </button>




        <p class="text-sm text-gray-600 mt-4">
            Sudah punya akun?
            <a class="text-blue-600 hover:underline" href="{{ route('login') }}">Masuk</a>
        </p>
    </form>

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
        });
    </script>
</body>

</html>
