<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap filter dari form
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query dasar
        $queryPemasukan = Pemasukan::query();
        $queryPengeluaran = Pengeluaran::query();

        // Filter harian
        if ($tanggal) {
            $queryPemasukan->whereDate('tanggal', $tanggal);
            $queryPengeluaran->whereDate('tanggal', $tanggal);
        }

        // Filter bulanan/tahunan
        if ($bulan && $tahun) {
            $queryPemasukan->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
            $queryPengeluaran->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        // Eksekusi query
        $pemasukans = $queryPemasukan->get();
        $pengeluarans = $queryPengeluaran->get();

        // Hitung total
        $totalPemasukan = $pemasukans->sum('jumlah');
        $totalPengeluaran = $pengeluarans->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('laporan.index', compact(
            'pemasukans',
            'pengeluarans',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'tanggal',
            'bulan',
            'tahun'
        ));
    }

    public function exportPDF(Request $request)
    {
        // Tangkap filter dari form
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query dasar
        $queryPemasukan = Pemasukan::query();
        $queryPengeluaran = Pengeluaran::query();

        if ($tanggal) {
            $queryPemasukan->whereDate('tanggal', $tanggal);
            $queryPengeluaran->whereDate('tanggal', $tanggal);
        }

        if ($bulan && $tahun) {
            $queryPemasukan->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
            $queryPengeluaran->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        $pemasukans = $queryPemasukan->get();
        $pengeluarans = $queryPengeluaran->get();
        $totalPemasukan = $pemasukans->sum('jumlah');
        $totalPengeluaran = $pengeluarans->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pdf = PDF::loadView('laporan.pdf', compact(
            'pemasukans',
            'pengeluarans',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'tanggal',
            'bulan',
            'tahun'
        ));

        return $pdf->download('laporan-keuangan.pdf');
    }
}
