<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\MyClass\KodeTransaksi;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        //  Mendapatkan Nilai Data Detai Transaksi Where Kode
        $kodeTransaksi = KodeTransaksi::formatKode();
        $detailTransaksi = DetailTransaksi::where('kode_transaksi', $kodeTransaksi)->get();

        // Mendapatkan Nilai Total Harga Dari jumlah Detail Transaksi
        $totalHarga = 0;
        foreach ($detailTransaksi as $detail) {
            $totalHarga += $detail->harga_total;
        }
        
        return view(
            'kasir.index',
            [
                'dataBarang' => $detailTransaksi,
                'hargaTotal' => $totalHarga
            ]
        );
    }
}
