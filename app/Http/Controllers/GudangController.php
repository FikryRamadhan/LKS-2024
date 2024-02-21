<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\MyClass\Validations;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index(){
        $barangs = Barang::all();
        return view('barang.index', [
            'barangs' => $barangs
        ]);
    }
}
