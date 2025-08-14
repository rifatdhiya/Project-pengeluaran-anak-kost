<h1>Edit Pengeluaran</h1>
<form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Keterangan:</label>
    <input type="text" name="keterangan" value="{{ $pengeluaran->keterangan }}"><br>
    <label>Jumlah:</label>
    <input type="number" step="0.01" name="jumlah" value="{{ $pengeluaran->jumlah }}"><br>
    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="{{ $pengeluaran->tanggal }}"><br>
    <label>Kategori:</label>
    <input type="text" name="kategori" value="{{ $pengeluaran->kategori }}"><br>
    <button type="submit">Update</button>
</form>
