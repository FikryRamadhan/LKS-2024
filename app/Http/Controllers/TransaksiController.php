<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Print Data Untuk Struk Pembayaran
     */
    public function print(Request $request){
        DB::beginTransaction();

        try {
            $data = [
                'no_transaksi' => $request->kode_transaksi,
                'tgl_transaksi' => date('Y-m-d H:i:s'),
                'total_bayar' => $request->total_bayar,
                'id_user' => $request->id_user,
            ];
            Transaksi::createTransaksi($data);
            $detailTransaksi = DetailTransaksi::where('kode_transaksi', $data['no_transaksi'])->get();
            
            DB::commit();

            $pdf = PDF::loadView('kasir.laporanPdf', [
                'data' => $data,
                'detail' => $detailTransaksi
            ]);

            $filename = date('YmdHi').".pdf";

            $pdf->save(storage_path('app/public/transaksi/'. $filename));
            
            return Response::success([
                'success' => true,
                'pdf' => $filename,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                'no_transaksi' => $request->kode_transaksi,
                'tgl_transaksi' => date('Y-m-d H:i:s'),
                'total_bayar' => $request->total_bayar,
                'id_user' => $request->id_user,
            ];
            Transaksi::createTransaksi($data);
            DB::commit();
            return Response::success();
        } catch (Exception $e) {
            DB::rollback();

            return Response::error($e);
        }
    }

    public function keranjang(Request $request){
        Validations::Transaksi($request);
        DB::beginTransaction();

        try {
            DetailTransaksi::createDetailTransaksi($request);
            DB::commit();

            return Response::success();
        } catch (Exception $e){
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function keranjangDelete(DetailTransaksi $keranjang){
        DB::beginTransaction();

        try {
            $keranjang->delete();
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
    
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
