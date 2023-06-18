@extends('dasboard.menu')
@section('konten')
<p class="card-title">Riwayat</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-1">no</th>
                    <th>nama pencukur</th>
                    <th>nama customer</th>
                    <th>harga</th>
                    <th>tanggal</th>
                    <th>jam</th>
                    <th>phone</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($riwayat as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->pencukur }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>Rp. {{ number_format($item->harga ) }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->waktu }}</td>
                        <td>{{ $item->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection