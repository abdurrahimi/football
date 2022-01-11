<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;

class TimController extends Controller
{
    //
    public function index()
    {
        return view('tim.index');
    }


    public function store(Request $req)
    {
        if(!empty($req->id)){
            $tim = Tim::find($req->id);
        }else{
            $tim = new Tim();
        }
        $tim->nama_tim = $req->nama_tim;
        $tim->tahun_berdiri = $req->tahun_berdiri;
        $tim->alamat = $req->alamat;
        $tim->kota = $req->kota;

        if($tim->save()){
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
        $tim = Tim::find($id);

        if($tim->delete()){
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
        $data = Tim::all();
        return response()->json([
            "result" => "OK",
            "msg"   => "Sukses",
            "data"  => $data,
        ]);
    }
}
