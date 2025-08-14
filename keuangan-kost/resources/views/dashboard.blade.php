<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Keuangan Anak Kost</title>

    <!-- ✅ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }

        nav {
            text-align: center;
            margin-bottom: 20px;
        }

        nav button {
            background: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 4px;
            cursor: pointer;
        }

        nav button:hover {
            background: #45a049;
        }

        .alert-success {
            background: #4CAF50;
            color: #fff;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .section { display: none; }
        .section.active { display: block; }

        form, table {
            background: #1E1E1E;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            width: 100%;
        }

        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 10px; }
        th { background: #333; }

        input, select {
            width: 100%; padding: 8px; margin-top: 5px;
            border: none; border-radius: 4px;
        }

        button.submit {
            margin-top: 10px; padding: 10px;
            background: #4CAF50; border: none;
            border-radius: 4px; cursor: pointer;
        }

        button.submit:hover { background: #45a049; }

        .modal-content {
            background: #1E1E1E; color: #fff;
        }

        td form { display: inline; }
    </style>
</head>
<body>
    <h1>Dashboard Keuangan Anak Kost</h1>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <nav>
        <button onclick="showSection('pemasukan')">Pemasukan</button>
        <button onclick="showSection('pengeluaran')">Pengeluaran</button>
        <button onclick="showSection('laporan')">Laporan</button>
    </nav>

    <!-- ✅ PEMASUKAN -->
    <div id="pemasukan" class="section active">
        <h2>Data Pemasukan</h2>
        <form method="POST" action="{{ route('pemasukan.store') }}">
            @csrf
            <label>Keterangan:</label>
            <input type="text" name="keterangan" required>

            <label>Jumlah:</label>
            <input type="number" name="jumlah" required>

            <label>Tanggal:</label>
            <input type="date" name="tanggal" required>

            <label>Kategori:</label>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Gaji">Gaji</option>
                <option value="Beasiswa">Beasiswa</option>
                <option value="Lain-lain">Lain-lain</option>
            </select>

            <button type="submit" class="submit">Tambah Pemasukan</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Keterangan</th><th>Kategori</th><th>Jumlah</th><th>Tanggal</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasukans as $pemasukan)
                <tr>
                    <td>{{ $pemasukan->keterangan }}</td>
                    <td>{{ $pemasukan->kategori }}</td>
                    <td>Rp {{ number_format($pemasukan->jumlah, 2) }}</td>
                    <td>{{ $pemasukan->tanggal }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editPemasukanModal{{ $pemasukan->id }}">
                            Edit
                        </button>
                        <form action="{{ route('pemasukan.destroy', $pemasukan->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- ✅ MODAL EDIT PEMASUKAN -->
                <div class="modal fade" id="editPemasukanModal{{ $pemasukan->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Pemasukan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST">
                          @csrf @method('PUT')
                          <label>Keterangan:</label>
                          <input type="text" name="keterangan" value="{{ $pemasukan->keterangan }}" required class="form-control">
                          <label>Jumlah:</label>
                          <input type="number" name="jumlah" value="{{ $pemasukan->jumlah }}" required class="form-control">
                          <label>Tanggal:</label>
                          <input type="date" name="tanggal" value="{{ $pemasukan->tanggal }}" required class="form-control">
                          <label>Kategori:</label>
                          <input type="text" name="kategori" value="{{ $pemasukan->kategori }}" required class="form-control">
                          <button type="submit" class="btn btn-success mt-3">Update</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ PENGELUARAN -->
    <div id="pengeluaran" class="section">
        <h2>Data Pengeluaran</h2>
        <form method="POST" action="{{ route('pengeluaran.store') }}">
            @csrf
            <label>Keterangan:</label>
            <input type="text" name="keterangan" required>
            <label>Jumlah:</label>
            <input type="number" name="jumlah" required>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required>
            <label>Kategori:</label>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makan">Makan</option>
                <option value="Transportasi">Transportasi</option>
                <option value="Hiburan">Hiburan</option>
                <option value="Belanja">Belanja</option>
                <option value="Lain-lain">Lain-lain</option>
            </select>
            <button type="submit" class="submit">Tambah Pengeluaran</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Keterangan</th><th>Kategori</th><th>Jumlah</th><th>Tanggal</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengeluarans as $pengeluaran)
                <tr>
                    <td>{{ $pengeluaran->keterangan }}</td>
                    <td>{{ $pengeluaran->kategori }}</td>
                    <td>Rp {{ number_format($pengeluaran->jumlah, 2) }}</td>
                    <td>{{ $pengeluaran->tanggal }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editPengeluaranModal{{ $pengeluaran->id }}">
                            Edit
                        </button>
                        <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- ✅ MODAL EDIT PENGELUARAN -->
                <div class="modal fade" id="editPengeluaranModal{{ $pengeluaran->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Pengeluaran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
                          @csrf @method('PUT')
                          <label>Keterangan:</label>
                          <input type="text" name="keterangan" value="{{ $pengeluaran->keterangan }}" required class="form-control">
                          <label>Jumlah:</label>
                          <input type="number" name="jumlah" value="{{ $pengeluaran->jumlah }}" required class="form-control">
                          <label>Tanggal:</label>
                          <input type="date" name="tanggal" value="{{ $pengeluaran->tanggal }}" required class="form-control">
                          <label>Kategori:</label>
                          <input type="text" name="kategori" value="{{ $pengeluaran->kategori }}" required class="form-control">
                          <button type="submit" class="btn btn-success mt-3">Update</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ LAPORAN -->
    <div id="laporan" class="section">
        <h2>Laporan Saldo</h2>
        <p><strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 2) }}</p>
        <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran, 2) }}</p>
        <p><strong>Saldo Akhir:</strong> Rp {{ number_format($saldo, 2) }}</p>
        <div style="width:300px;height:300px;"><canvas id="myChart"></canvas></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showSection(id) {
            document.querySelectorAll('.section').forEach(sec => sec.classList.remove('active'));
            document.getElementById(id).classList.add('active');
        }

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
</body>
</html>
