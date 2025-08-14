<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        Pemasukan::create($request->only(['keterangan', 'jumlah', 'tanggal', 'kategori']));

        return redirect()->route('dashboard')->with('success', 'Pemasukan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->only(['keterangan', 'jumlah', 'tanggal', 'kategori']));

        return redirect()->route('dashboard')->with('success', 'Pemasukan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('dashboard')->with('success', 'Pemasukan berhasil dihapus!');
    }
}
