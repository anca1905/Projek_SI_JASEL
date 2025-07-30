<x-mail::message>
# Introduction

Terima kasih telah mendaftar. Silakan verifikasi email kamu atau mulai membuat pesanan!

<x-mail::button :url="route('costumer.make_an_order')">
Buat Pesanan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
