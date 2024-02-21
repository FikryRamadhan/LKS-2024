<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index', [
            'logs' => Log::orderBy('id', 'DESC')->get(),
            'hargaTotal' => 0,
        ]);
    }
}
