<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-6">
        <h2 class="text-2xl font-bold mb-4">Detail Produk</h2>

        <div class="space-y-3">
            @foreach ($data as $d)
                <p><strong>ID:</strong> {{ $d['id'] }}</p>
                <p><strong>Nama:</strong> {{ $d['name'] }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($d['price'], 0, ',', '.') }}</p>
                <p><strong>Deskripsi:</strong> {{ $d['description'] }}</p>
                <p><strong>Dibuat:</strong> {{ \Carbon\Carbon::parse($d['created_at'])->format('d-m-Y H:i') }}</p>
                <p><strong>Diupdate:</strong> {{ \Carbon\Carbon::parse($d['updated_at'])->format('d-m-Y H:i') }}</p>
            @endforeach
        </div>
    </div>
</body>

</html>
