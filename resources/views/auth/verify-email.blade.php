<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Verifikasi Email</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
  <div class="w-full max-w-md rounded-xl bg-white p-6 shadow">
    <h1 class="text-xl font-semibold text-slate-900">Verifikasi Email Diperlukan</h1>
    <p class="mt-2 text-slate-600">
      Kami telah mengirimkan link verifikasi ke email Anda. Silakan cek inbox (dan folder spam).
    </p>

    @if (session('status'))
      <div class="mt-3 rounded border border-blue-200 bg-blue-50 text-blue-800 px-3 py-2 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mt-5">
      @csrf
    <form method="POST" action="{{ route('otp.verify') }}" class="mt-4 space-y-3">
      @csrf
      <label class="block text-sm font-medium text-slate-700">Kode OTP (6 digit)</label>
      <input name="code" inputmode="numeric" maxlength="6" pattern="\d{6}"
             autocomplete="one-time-code"
             class="w-full border rounded px-3 py-2 text-center tracking-[0.6em]" required>
      <button class="w-full bg-slate-800 text-white rounded py-2">Verifikasi</button>
    </form>

    <p class="text-sm text-slate-600 mt-3">
      Kode habis dalam <b id="t">{{ (int)($secondsLeft ?? 0) }}</b> detik.
    </p>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-2">
      @csrf
      <button id="r" class="text-blue-600 text-sm underline" disabled>Kirim ulang kode</button>
    </form>
  </div>

<script>
  let s = Number(document.getElementById('t').textContent||0);
  const r = document.getElementById('r');
  const t = setInterval(()=>{ if(s<=0){r.disabled=false;return clearInterval(t)} s--; document.getElementById('t').textContent=s; },1000);
</script>
</body>
</html>

      <button type="submit"
        class="w-full text-white py-2 rounded bg-gradient-to-r from-[#0F1E33] via-[#2B4F7D] to-[#7EA2CC]">
        Kirim Ulang Email Verifikasi
      </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3 text-center">
      @csrf
      <button class="text-sm text-slate-600 hover:underline">Keluar</button>
    </form>
  </div>
</body>
</html>
