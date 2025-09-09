{{-- <x-mail::message>
# Introduction

<h1>Halo {{ $user->name }}</h1>
<p>Selamat datang di aplikasi kami!</p>


Terima kasih telah mendaftar. Silakan verifikasi email kamu atau mulai membuat pesanan!

<x-mail::button :url="route('costumer.make_an_order')">
Buat Pesanan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <h1>Halo, {{ $user->name }} 🎉</h1>
    <p>Selamat datang di aplikasi Laravel! Ini email percobaan dari Mailtrap.</p>
</body>
</html>
