<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $req)
    {
        if(Auth::attempt($req->all())){
            return response()->json([
                "result" => "OK",
                "msg"   => "Berhasil login"
            ]);
        }

        return response()->json([
            "result" => "FAIL",
            "msg"   => "Username atau Password tidak valid"
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
