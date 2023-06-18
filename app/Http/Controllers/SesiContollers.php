<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiContollers extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' =>'required',
            'password'=>'required',
        ],[
            'email.required'=> 'Email wajib diisi',
            'password.required'=> 'Password wajib diisi',
        ]);

        $infologin = [
            'email' =>$request->email,
            'password' =>$request->password,
        ];

        if(Auth::attempt($infologin)){
           if(Auth::user()->role == 'user'){
                return redirect('admin/user');
           };
        }else{
            return redirect('')->withErrors('username dan password yang dimasukan tidak msesuai')->withInput();
        }
    }

    public function register(){
        return view('register');
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>bcrypt($request->password)
        ]);
        return redirect('/')->with('success', 'Berhasil daftar');
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
