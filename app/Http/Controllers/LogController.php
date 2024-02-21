<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $filter = $request->filter;
        $logs = Log::where('waktu', $filter)->get();
        return view('admin.index', [
            'logs' => $logs
        ]);
    }
}
