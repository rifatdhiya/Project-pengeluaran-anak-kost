<h1>Edit Pemasukan</h1>
<form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Keterangan:</label>
    <input type="text" name="keterangan" value="{{ $pemasukan->keterangan }}"><br>
    <label>Jumlah:</label>
    <input type="number" step="0.01" name="jumlah" value="{{ $pemasukan->jumlah }}"><br>
    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="{{ $pemasukan->tanggal }}"><br>
    <button type="submit">Update</button>
</form>
