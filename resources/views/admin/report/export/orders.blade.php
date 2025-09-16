<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Orders</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .kop {
            text-align: center;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .kop h2, .kop h3 {
            margin: 0;
            line-height: 1.4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        .footer {
            margin-top: 40px;
            width: 100%;
            text-align: right;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop">
        <h2>PT. Nama Perusahaan</h2>
        <h3>Laporan Data Orders</h3>
        <p>Tanggal: {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    <!-- Isi Tabel -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Service</th>
                <th>Teknisi</th>
                <th>Tanggal Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $i => $order)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>{{ $order->manageService->nama ?? '-' }}</td>
                    <td>{{ $order->teknisi->nama ?? '-' }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer tanda tangan -->
    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>(________________)</strong></p>
    </div>

</body>
</html>
