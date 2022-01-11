<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class StatisticController extends Controller
{
    //
    public function index()
    {
        return view('statistic.index');
    }

    public function get_match()
    {
        $data = Jadwal::with(['home','away','goal.goal'])
        ->has('home')
        ->has('away')
        ->where('date','>','DATE(NOW())')
        ->get();
        return response()->json([
            "result" => "OK",
            "msg"   => "Sukses",
            "data"  => $data,
        ]);
    }
}
