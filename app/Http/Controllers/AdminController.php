<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\halaman;
use App\Models\Riwayat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // function index()
    // {
    //     return view('dasboard');
    // }
    function user()
    {
        $riwayat = DB::table('riwayats')->join('halaman','halaman.id', 'riwayats.pencukur_id')->where('user_id', Auth::user()->id)->select('*', 'halaman.nama as pencukur', 'riwayats.nama as customer')->get();
        $halaman = halaman::get();
        $admin = User::where('role', 'admin')->first();
        // dd($riwayat);
        return view('dasboard.user.index', ['riwayat' => $riwayat, 'halaman' => $halaman, 'admin' => $admin]);
    }

    public function form_booking($id){
        return view('ngarep.cekin', ['id' => $id]);
    }

    public function booking(Request $request){
        $request->validate([
            'nama' => ['required'],
            'tanggal' => ['required'],
            'phone' => ['required'],
            'waktu' => ['required'],
            'alamat' => ['required'],
        ]);

        Riwayat::create([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'phone' => $request->phone,
            'waktu' => $request->waktu,
            'harga' => $request->harga,
            'alamat' => $request->alamat,
            'pencukur_id' => $request->id,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/admin/user#experience');
    }
}
