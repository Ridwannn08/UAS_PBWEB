@extends('dasboard.menu')
@section('konten')
    <div class="pb-3"><a href="{{route('halaman.index')}}" class="btn btn-secondary">
            kembali</a>
    </div>
    <form action="{{route('halaman.update',$data->id)}}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="nama" class="form-label">nama</label>
          <input type="text"
            class="form-control form-control-sm" name="nama" id="nama" aria-describedby="helpId" placeholder="nama " value="{{$data->nama}}" >
          {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">deskripsi</label>
          <textarea class="form-control summernote" rows="5" name="deskripsi">{{$data->deskripsi}}</textarea>
        </div>
        @if ($data->foto)
            <div class="mb3">
              <img  style = "max-width: 50px; max-height: 50px" src = "{{url('foto').'/'.$data->foto}}"/>
            </div>
        @endif
        <div class="mb-3">
          <label for="deskripsi" class="form-label">foto</label>
          <input type="file" class="form-control" name="foto" id="foto">
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">Simpan</button>
    </form>
@endsection
