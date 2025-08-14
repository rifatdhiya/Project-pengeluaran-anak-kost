<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Saldo</title>
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        .card {
            background: #1E1E1E;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        label {
            display: inline-block;
            width: 100px;
            margin-top: 10px;
        }

        input, select {
            padding: 8px;
            border: none;
            border-radius: 4px;
            margin-top: 10px;
            width: calc(100% - 120px);
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            font-size: 1.2em;
            max-width: 600px;
            margin: 0 auto;
        }

        hr {
            border: 1px solid #333;
            max-width: 600px;
            margin: 20px auto;
        }

        .chart-container {
            width: 200px;
            height: 200px;
            margin: 20px auto;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .flex-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <h1>Laporan Keuangan Anak Kost</h1>

    <div class="card">
        <form method="GET" action="{{ url('/laporan') }}">
            <h3>Filter</h3>

            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}"><br>

            <label>Bulan:</label>
            <select name="bulan">
                <option value="">--Pilih Bulan--</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select><br>

            <label>Tahun:</label>
            <input type="number" name="tahun" value="{{ $tahun ?? date('Y') }}"><br>

            <div class="flex-buttons">
                <button type="submit">Terapkan Filter</button>
                <form method="GET" action="{{ url('/laporan/pdf') }}">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <button type="submit">Export PDF</button>
                </form>
            </div>
        </form>
    </div>

    <p><strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 2) }}</p>
    <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran, 2) }}</p>
    <p><strong>Saldo Akhir:</strong> Rp {{ number_format($saldo, 2) }}</p>

    <hr>

    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}],
                    backgroundColor: ['#4CAF50', '#F44336'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#f1f1f1' } },
                    title: {
                        display: true,
                        text: 'Perbandingan Pemasukan vs Pengeluaran',
                        color: '#f1f1f1'
                    }
                }
            }
        });
    </script>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ url('/pemasukan') }}">Data Pemasukan</a> |
        <a href="{{ url('/pengeluaran') }}">Data Pengeluaran</a>
    </div>
</body>
</html>
