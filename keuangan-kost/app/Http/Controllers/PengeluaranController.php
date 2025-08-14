<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        Pengeluaran::create($request->only(['keterangan', 'jumlah', 'tanggal', 'kategori']));

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->only(['keterangan', 'jumlah', 'tanggal', 'kategori']));

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
