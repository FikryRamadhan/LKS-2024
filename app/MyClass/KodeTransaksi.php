<?php

namespace App\MyClass;

use App\Models\Transaksi;
use Carbon\Carbon;

class KodeTransaksi {

    public static function formatKode() {
        $transaksiTerbaru = Transaksi::orderBy('created_at', 'DESC');
        $transaksi = $transaksiTerbaru->first();

        if($transaksi){
            $noTransaksi = $transaksi->no_transaksi;
            $explode = explode('/', $noTransaksi);
            $noUrut = (int) $explode[1];
            $noUrut++;
        } else {
            $noUrut = 1;
        }

        $urutan = str_pad($noUrut,3,0,STR_PAD_LEFT);

        return "TRX/".$urutan;
    }

}