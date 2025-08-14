<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan PDF</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Laporan Keuangan Anak Kost</h1>

    <p><strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan) }}</p>
    <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran) }}</p>
    <p><strong>Saldo Akhir:</strong> Rp {{ number_format($saldo) }}</p>

    <h3>Pemasukan</h3>
    <table>
        <thead>
            <tr><th>Keterangan</th><th>Jumlah</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            @foreach ($pemasukans as $item)
            <tr>
                <td>{{ $item->keterangan }}</td>
                <td>Rp {{ number_format($item->jumlah) }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Pengeluaran</h3>
    <table>
        <thead>
            <tr><th>Keterangan</th><th>Jumlah</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            @foreach ($pengeluarans as $item)
            <tr>
                <td>{{ $item->keterangan }}</td>
                <td>Rp {{ number_format($item->jumlah) }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
