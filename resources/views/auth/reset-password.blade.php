<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Atur Ulang Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
  <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
    <h1 class="text-xl font-semibold text-slate-900">Atur Ulang Password</h1>

    <form method="POST" action="{{ route('password.update') }}" class="mt-4 space-y-4">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <div>
        <label class="block text-sm font-medium text-slate-700">Password Baru</label>
        <input id="password" type="password" name="password" required
               class="mt-1 w-full rounded border-slate-300 focus:border-slate-500 focus:ring-slate-500">
        @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
               class="mt-1 w-full rounded border-slate-300 focus:border-slate-500 focus:ring-slate-500">
      </div>

      <button type="submit"
        class="w-full text-white py-2 rounded bg-gradient-to-r from-[#0F1E33] via-[#2B4F7D] to-[#7EA2CC]">
        Simpan Password
      </button>

      <div class="text-center">
        <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:underline">Kembali ke Login</a>
      </div>
    </form>
  </div>
</body>
</html>
