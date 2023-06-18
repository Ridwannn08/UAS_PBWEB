@extends('dasboard.menu')
@section('konten')
    <div class="pb-3"><a href="{{route('halaman.index')}}" class="btn btn-secondary">
            kembali</a>
    </div>
    <form action="{{route('halaman.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">nama</label>
          <input type="text"
            class="form-control form-control-sm" name="nama" id="nama" aria-describedby="helpId" placeholder="nama " value="{{Session::get('nama')}}" >
          {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">deskripsi</label>
          <textarea class="form-control summernote" rows="5" name="deskripsi">{{Session::get('deskripsi')}}</textarea>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">foto</label>
          <input type="file" class="form-control" name="foto" id="foto">
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">Simpan</button>
    </form>
@endsection
