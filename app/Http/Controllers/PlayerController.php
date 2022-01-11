<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Pemain;


class PlayerController extends Controller
{
    //

    public function list_by_team($id="")
    {
        if(empty($id)){
            redirect('/');
        }
        $data['tim'] = Tim::where('id',$id)->first();
        return view('player.index',$data);
    }

    public function get_player_by_team($id)
    {
        $data = Pemain::where('team_id',$id)->get();
        return response()->json([
            "result" => "OK",
            "msg"   => "Sukses",
            "data"  => $data,
        ]);
    }

    public function store(Request $req)
    {
        //dd($req->all());
        if(!empty($req->id)){
            $data = Pemain::find($req->id);
            $check = Pemain::where('team_id',$req->team_id)->where('id','!=',$req->id)->where('nomor_punggung',$req->nomor_punggung)->first();
            if(!empty($check)){
                return response()->json([
                    "result" => "FAIL",
                    "msg"   => "Nomor punggung sudah digunakan"
                ]);
            }
        }else{
            $data = new Pemain();
            $check = Pemain::where('team_id',$req->team_id)->where('nomor_punggung',$req->nomor_punggung)->first();
            if(!empty($check)){
                return response()->json([
                    "result" => "FAIL",
                    "msg"   => "Nomor punggung sudah digunakan"
                ]);
            }
        }
        $data->nama_pemain = $req->nama_pemain;
        $data->tinggi = $req->tinggi;
        $data->posisi = $req->posisi;
        $data->team_id = $req->team_id;
        $data->nomor_punggung = $req->nomor_punggung;
        if($data->save()){
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
        $data = Pemain::find($id);

        if($data->delete()){
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
}
