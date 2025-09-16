<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Orders - PT. Skillance Digital Indonesia</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* KOP SURAT */
        .kop {
            display: flex;
            align-items: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-logo {
            height: 70px;
            margin-right: 15px;
        }

        .kop-text h2 {
            font-size: 20px;
            margin: 0;
            font-weight: bold;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 10px;
        }

        /* JUDUL */
        .judul-laporan {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul-laporan h3 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .judul-laporan p {
            margin: 3px 0;
            font-size: 11px;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #eaeaea;
            font-weight: bold;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* FOOTER TANDA TANGAN */
        .footer {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-around; /* Mengatur jarak antar kolom */
        }

        .tanda-tangan {
            text-align: center;
            width: 45%;
        }

        .tanda-tangan p {
            margin: 4px 0;
        }

        .tanda-tangan .nama {
            margin-top: 60px;
            font-weight: bold;
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 180px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="kop">
            <img class="kop-logo" src="https://i.ibb.co/6P6Xg4T/image-6501bd.png" alt="Logo PT. Skillance Digital Indonesia">
            <div class="kop-text">
                <h2>PT. SKILLANCE DIGITAL INDONESIA</h2>
                <p>Jalan Kemakmuran Nomor 123, Kota Jakarta Selatan, 12345</p>
                <p>Email: info@skillance.id | Telepon: (021) 1234 5678</p>
            </div>
        </div>

        <div class="judul-laporan">
            <h3>LAPORAN DATA TRANSAKSI PEMESANAN</h3>
            <p>Periode: {{ $startDate ?? '...' }} s.d. {{ $endDate ?? '...' }}</p>
            <p>Tanggal Cetak: {{ now()->translatedFormat('d F Y') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Order</th>
                    <th>Nama User</th>
                    <th>Layanan</th>
                    <th>Teknisi</th>
                    <th>Harga</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $i => $order)
                <tr>
                    <td style="text-align:center">{{ $i + 1 }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>{{ $order->manageService->name ?? '-' }}</td>
                    <td>{{ $order->teknisi->name ?? '-' }}</td>
                    <td>Rp {{ number_format($order->price, 0, ',', '.') ?? '-' }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($order->status) ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <div class="tanda-tangan">
                <p>Mengetahui,</p>
                <p>Direktur Utama</p>
                <p class="nama">(_________________)</p>
            </div>
        </div>
    </div>
</body>
</html>