@extends('dasboard.menu')
@section('konten')
<p class="card-title">Pencukur</p>
    <div class="pb-3"><a href="{{ route('halaman.create')}}" class="btn btn-primary">+ Tambah Orang</a></div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-1">no</th>
                    <th>foto</th>
                    <th>nama</th>
                    <th>deskripsi</th>
                    <th class="col-2">aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)

                <tr>
                    <td>{{$i}}</td>
                    <td>
                        @if ($item->foto)
                            <img style="max-width:50px;max-height:50px" src="{{url('foto').'/'.$item->foto}}"/>   
                        @endif
                    </td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->deskripsi}}</td>
                    <td>
                        <a href="{{route('halaman.edit',$item->id)}}" class="btn btn-sm btn-warning">edit</a>
                        <form onsubmit="return confirm('yakin mau hapus data ini')"action="{{route('halaman.destroy',$item->id)}}"
                            class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit" name="delete"> hapus</button>
                        </form>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection