<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

    public function store(Request $request)
    {
        Validations::storeBarang($request);
        DB::beginTransaction();

        try {
            Barang::storeBarang($request);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }

    }

    public function edit(Barang $barang)
    {
        try {
            return Response::success([
                'barang' => $barang
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function update(Request $request, Barang $barang)
    {
        Validations::updateBarang($request);
        DB::beginTransaction();

        try {
            $barang->updateBarang($request);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function destroy(Barang $barang)
    {
        DB::beginTransaction();

        try{
            $barang->deleteBarang();
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
