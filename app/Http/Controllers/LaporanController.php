<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(){
        $transaksi = Transaksi::all();
        $data = Transaksi::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_bayar) as omset')
        )
        ->groupBy('date')
        ->get();

        $labels = $data->pluck('date');
        $values = $data->pluck('omset');

        return view('laporan.index', [
            'transaksis' => $transaksi,
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
