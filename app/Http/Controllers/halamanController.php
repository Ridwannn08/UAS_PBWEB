<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class halamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= halaman::orderBy('nama','asc')->get();
        return view('dasboard.halaman.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dasboard.halaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama',$request->nama);
        Session::flash('deskripsi',$request->deskripsi);
        $request->validate(
            [
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required',
            ],[
                'nama.required'=>'nama wajib diisi',
                'deskripsi.required'=>'deskripsi wajib diisi',
                'foto.required'=>'foto wajib diisi',
            ]
        );
        $foto_file =$request->file('foto');
        $foto_ektensi = $foto_file->extension();
        $foto_nama = date("ymdhis"). ".".$foto_ektensi;
        $foto_file->move(public_path('foto'),$foto_nama);
        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto_nama
        ];
        halaman::create($data);
        
        return redirect()->route('halaman.index')->with('succes','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data= halaman::where('id',$id)->first();
        return view('dasboard.halaman.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
            'nama' => 'required',
            'deskripsi' => 'required',
            // 'foto' => 'required',
            ],[
                'nama.required'=>'nama wajib diisi',
                'deskripsi.required'=>'deskripsi wajib diisi',
                // 'foto.required'=>'foto wajib diisi',
            ]
        );
        $data = [];
        $halaman = halaman::find($id);
         if($request->hasFile('foto')) {
             $request->validate([
                'foto' => 'mimes:jpeg,jpg,png.gif',
            ],[
                'foto.mimes'=>'foto wajib diisi jpg,jpeg'
            ]);
            $foto_file =$request->file('foto');
            $foto_ektensi = $foto_file->extension();
            $foto_nama = date("ymdhis"). ".".$foto_ektensi;
            $foto_file->move(public_path('foto'),$foto_nama);
            
            $data_foto = halaman::where('id',$id)->first();
            File::delete(public_path('foto').'/'.$data_foto->foto);
            
            $halaman->foto = $foto_nama;
        }
        
        $halaman->nama = $request->nama;
        $halaman->deskripsi = $request->deskripsi;
        $halaman->save();
        // halaman::where('id',$id)->update($data);
        
        return redirect()->route('halaman.index')->with('succes','berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = halaman::where('id', $id)->first();
        File::delete(public_path('foto').'/'.$data->foto);

        halaman::where('id', $id)->delete();
        return redirect()->route('halaman.index')->with('succes','berhasil menghapus data');
    }
}
