<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data pemasukan & pengeluaran
        $pemasukans = Pemasukan::all();
        $pengeluarans = Pengeluaran::all();

        // Hitung total saldo
        $totalPemasukan = $pemasukans->sum('jumlah');  // bisa juga pakai query langsung
        $totalPengeluaran = $pengeluarans->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('dashboard', compact(
            'pemasukans',
            'pengeluarans',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));
    }
}
