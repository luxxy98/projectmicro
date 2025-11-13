<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Verifikasi Email (OTP)</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100 p-4">
  <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
    <h1 class="text-lg font-semibold">Verifikasi Email</h1>
    <p class="text-sm text-slate-600 mt-1">Kami kirim kode ke {{ $maskedEmail ?? '' }}</p>

    @if (session('status'))
      <div class="mt-3 text-green-600 text-sm">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
      <div class="mt-3 text-red-600 text-sm">{{ $errors->first() }}</div>
    @endif

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
  const t = setInterval(()=>{
    if(s<=0){ r.disabled=false; return clearInterval(t); }
    s--; document.getElementById('t').textContent = s;
  }, 1000);
</script>
</body>
</html>

<button type="submit" class="btn btn-link text-gray-600">
    ← Kembali ke Pendaftaran
  </button>