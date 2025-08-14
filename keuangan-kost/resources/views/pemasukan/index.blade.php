<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemasukan</title>
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
        }

        form {
            background: #1E1E1E;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 4px;
            margin-top: 5px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #1E1E1E;
        }

        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #333;
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <h1>Data Pemasukan</h1>

    <form method="POST" action="{{ url('/pemasukan') }}">
        @csrf
        <label>Keterangan:</label>
        <input type="text" name="keterangan" required>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>

        <button type="submit">Tambah Pemasukan</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukans as $pemasukan)
                <tr>
                    <td>{{ $pemasukan->keterangan }}</td>
                    <td>Rp {{ number_format($pemasukan->jumlah, 2) }}</td>
                    <td>{{ $pemasukan->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="link">
        <a href="{{ url('/laporan') }}">Laporan</a> |
        <a href="{{ url('/pengeluaran') }}">Data Pengeluaran</a>
    </div>
</body>
</html>
