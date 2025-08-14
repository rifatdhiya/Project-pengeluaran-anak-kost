<h1>Tambah Pengeluaran</h1>
<form action="{{ route('pengeluaran.store') }}" method="POST">
    @csrf
    <label>Keterangan:</label>
    <input type="text" name="keterangan"><br>
    <label>Jumlah:</label>
    <input type="number" step="0.01" name="jumlah"><br>
    <label>Tanggal:</label>
    <input type="date" name="tanggal"><br>
    <label>Kategori:</label>
    <input type="text" name="kategori"><br>
    <button type="submit">Simpan</button>
</form>
