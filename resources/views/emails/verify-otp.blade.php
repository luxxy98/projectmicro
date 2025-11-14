@php /** Email SEDERHANA, tanpa form & countdown detik */ @endphp
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Kode Verifikasi SiberLogin</title>
</head>
<body>
  <p>Halo,</p>
  <p>Kode verifikasi Anda: <strong>{{ $code }}</strong></p>
  <p>Kode berlaku selama <strong>{{ $minutes }}</strong> menit.</p>
  @if(!empty($maskedEmail))
    <p>Dikirim ke: {{ $maskedEmail }}</p>
  @endif
  <p>Jika Anda tidak meminta kode ini, abaikan email ini.</p>
</body>
</html>
