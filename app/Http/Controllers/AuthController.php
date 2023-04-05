<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = [
            "admin"=>"password",
            ];
        if(array_key_exists($request->username, $credentials) && $request->password == $credentials[$request->username] ){
            session(['username' => $request->username, 'password'=> $request->password]);
            return redirect()->back()->withInput()->with(['message'=>'Přihlášení proběhlo v pořádku']);
        }
        return redirect()->back()->with(['message'=>'Údaje se neshodují']);
    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->back()->with(['message'=>'Odhlášeno ze systému']);;
    }
}
