<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Lupa Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
  <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
    <h1 class="text-xl font-semibold text-slate-900">Lupa Password</h1>
    <p class="mt-1 text-sm text-slate-600">Masukkan email yang terdaftar. Kami akan mengirimkan link untuk mengatur ulang kata sandi.</p>

    @if (session('status'))
      <div class="mt-3 rounded border border-emerald-200 bg-emerald-50 text-emerald-800 px-3 py-2 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-4 space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="mt-1 w-full rounded border-slate-300 focus:border-slate-500 focus:ring-slate-500">
        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <button type="submit"
        class="w-full text-white py-2 rounded bg-gradient-to-r from-[#0F1E33] via-[#2B4F7D] to-[#7EA2CC]">
        Kirim Link Reset
      </button>

      <div class="text-center">
        <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:underline">Kembali ke Login</a>
      </div>
    </form>
  </div>
</body>
</html>
