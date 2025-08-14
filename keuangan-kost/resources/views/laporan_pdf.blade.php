<!DOCTYPE html>
<html>
<head>
    <title>Laporan PDF</title>
    <style>
        body { font-family: sans-serif; }
    </style>
</head>
<body>
    <h1>Laporan Keuangan Anak Kost</h1>
    @if($tanggal)
        <p>Per Tanggal: {{ $tanggal }}</p>
    @elseif($bulan && $tahun)
        <p>Periode: Bulan {{ $bulan }}, Tahun {{ $tahun }}</p>
    @endif

    <p><strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 2) }}</p>
    <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran, 2) }}</p>
    <p><strong>Saldo Akhir:</strong> Rp {{ number_format($saldo, 2) }}</p>
</body>
</html>
