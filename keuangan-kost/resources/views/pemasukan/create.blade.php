<form action="{{ route('pemasukan.store') }}" method="POST">
    @csrf

    <label>Keterangan:</label>
    <input type="text" name="keterangan" required><br>

    <label>Jumlah:</label>
    <input type="number" name="jumlah" required><br>

    <label>Tanggal:</label>
    <input type="date" name="tanggal" required><br>

    <button type="submit">Simpan</button>
</form>
