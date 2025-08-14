<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Anak Kost</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #121212; color: #f1f1f1; font-family: sans-serif; padding: 40px;
        }
        h1, h3 { color: #4CAF50; }
        form { margin-bottom: 20px; }
        label { display: inline-block; margin-right: 10px; }
        input { margin-right: 10px; padding: 5px; }
        button, a.btn {
            background: #4CAF50; padding: 10px 20px; color: #fff;
            text-decoration: none; border-radius: 4px; border: none; cursor: pointer;
        }
        a.btn { display: inline-block; margin-top: 10px; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 20px; background: #1E1E1E;
        }
        th, td {
            border: 1px solid #333; padding: 10px; text-align: left;
        }
        th { background: #333; }
    </style>
</head>
<body>
    <h1>Laporan Keuangan Anak Kost</h1>

    <!-- ✅ FORM FILTER -->
    <form method="GET" action="{{ url('/laporan') }}">
        <label>Tanggal:</label>
        <input type="date" name="tanggal" value="{{ $tanggal }}">
        <label>Bulan:</label>
        <input type="number" name="bulan" value="{{ $bulan }}" min="1" max="12">
        <label>Tahun:</label>
        <input type="number" name="tahun" value="{{ $tahun }}">
        <button type="submit">Filter</button>
    </form>

    <!-- ✅ RINGKASAN -->
    <p><strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan) }}</p>
    <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran) }}</p>
    <p><strong>Saldo Akhir:</strong> Rp {{ number_format($saldo) }}</p>

    <!-- ✅ BUTTON EXPORT PDF (PASTI MUNCUL) -->
    <form method="GET" action="{{ route('laporan.pdf') }}" target="_blank" style="margin-bottom: 20px;">
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
        <input type="hidden" name="bulan" value="{{ $bulan }}">
        <input type="hidden" name="tahun" value="{{ $tahun }}">
        <button type="submit">📄 Export PDF</button>
    </form>

    <!-- ✅ GRAFIK -->
    <h3>Grafik Perbandingan</h3>
    <canvas id="chart" width="400" height="400"></canvas>

    <!-- ✅ DATA PEMASUKAN -->
    <h3>Data Pemasukan</h3>
    <table>
        <thead>
            <tr><th>Keterangan</th><th>Kategori</th><th>Jumlah</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            @forelse ($pemasukans as $item)
            <tr>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->kategori }}</td>
                <td>Rp {{ number_format($item->jumlah) }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            @empty
            <tr><td colspan="4">Tidak ada data pemasukan.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- ✅ DATA PENGELUARAN -->
    <h3>Data Pengeluaran</h3>
    <table>
        <thead>
            <tr><th>Keterangan</th><th>Kategori</th><th>Jumlah</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            @forelse ($pengeluarans as $item)
            <tr>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->kategori }}</td>
                <td>Rp {{ number_format($item->jumlah) }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            @empty
            <tr><td colspan="4">Tidak ada data pengeluaran.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- ✅ GRAFIK SCRIPT -->
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    label: 'Keuangan',
                    data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}],
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.7)',
                        'rgba(244, 67, 54, 0.7)'
                    ],
                    borderColor: [
                        'rgba(76, 175, 80, 1)',
                        'rgba(244, 67, 54, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#f1f1f1' }
                    },
                    x: {
                        ticks: { color: '#f1f1f1' }
                    }
                }
            }
        });
    </script>
</body>
</html>
