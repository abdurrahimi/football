<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    //
    public function index()
    {
        $data['team'] = Tim::all();
        //dd($data);
        return view('jadwal.index',$data);
    }

    public function store(Request $req)
    {
        if(!empty($req->id)){
            $jadwal = Jadwal::find($req->id);
        }else{
            $jadwal = new Jadwal();
        }
        $jadwal->home_id = $req->home_id;
        $jadwal->away_id = $req->away_id;
        $jadwal->date = date('Y-m-d H:i:s',strtotime($req->date));
        if($jadwal->save()){
            return response()->json([
                "result" => "OK",
                "msg"   => "Berhasil menyimpan data"
            ]);
        }else{
            return response()->json([
                "result" => "FAIL",
                "msg"   => "Gagal menyimpan data"
            ]);
        }
    }

    public function delete($id)
    {
        $jadwal = Jadwal::find($id);

        if($jadwal->delete()){
            return response()->json([
                "result" => "OK",
                "msg"   => "Berhasil menghapus data"
            ]);
        }else{
            return response()->json([
                "result" => "FAIL",
                "msg"   => "Gagal menghapus data"
            ]);
        }
    }

    public function datatables(Request $req)
    {
        $data = Jadwal::with(['home','away'])->has('home')->has('away')->get();
        return response()->json([
            "result" => "OK",
            "msg"   => "Sukses",
            "data"  => $data,
        ]);
    }
}
