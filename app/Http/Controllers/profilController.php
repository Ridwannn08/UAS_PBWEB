<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PHPUnit\Metadata\Metadata as MetadataMetadata;
use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;

class profilController extends Controller
{
    function index()
    {
        return view('dasboard.profil.index');
    }
    function update(Request $request)
    {
        $request->validate([
            '_foto' => 'mimes:jpeg,jpg,png,gif',
            '_email' => 'required|email'
        ], [
            '_foto.mimes' => 'Foto yang dimasukkan hanya diperbolehkan berkestensi JPEG, JPG, PNG, dan GIF',
            '_email.required' => 'Email wajib diisi',
            '_email.email' => 'Format email yang dimasukkan tidak valid'
        ]);

        // $about = new About();

        if ($request->hasFile('_foto')) {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis') . ".$foto_ekstensi";
            $foto_file->move(public_path('foto'), $foto_baru);
            // kalau ada update foto
            $foto_lama = get_meta_value('foto_foto');
            File::delete(public_path('foto') . "/" . $foto_lama);


            // $about->photo = $foto_baru;
            metadata::updateOrCreate(['meta_key' => '_foto'], ['meta_value' => $foto_baru]);
        }

        // $about->email = $request->email;
        // $about->kota = $request->_kota;
        // $about->provinsi = $request->_provinsi;
        // $about->phone = $request->_nohp;
        // $about->facebook = $request->_facebook;
        // $about->twitter = $request->_twitter;
        // $about->linkedin = $request->_linkedin;
        // $about->github = $request->_github;
        // $about->save();
        metadata::updateOrCreate(['meta_key' => '_email'], ['meta_value' => $request->_email]);
        metadata::updateOrCreate(['meta_key' => '_kota'], ['meta_value' => $request->_kota]);
        metadata::updateOrCreate(['meta_key' => '_provinsi'], ['meta_value' => $request->_provinsi]);
        metadata::updateOrCreate(['meta_key' => '_nohp'], ['meta_value' => $request->_nohp]);


        metadata::updateOrCreate(['meta_key' => '_facebook'], ['meta_value' => $request->_facebook]);
        metadata::updateOrCreate(['meta_key' => '_twitter'], ['meta_value' => $request->_twitter]);
        metadata::updateOrCreate(['meta_key' => '_linkedin'], ['meta_value' => $request->_linkedin]);
        metadata::updateOrCreate(['meta_key' => '_github'], ['meta_value' => $request->_github]);

        return redirect()->route('profil.index')->with('success', 'Berhasil update data profile');
    }

    public function riwayat(){
        $riwayat = DB::table('riwayats')->join('halaman','halaman.id', 'riwayats.pencukur_id')->select('*', 'halaman.nama as pencukur', 'riwayats.nama as customer')->get();
        return view('dasboard.riwayat', ['riwayat' => $riwayat]);
    }
}