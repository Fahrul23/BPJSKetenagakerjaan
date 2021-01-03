@extends('template.exports.stylePDF')

@section('laporan')

    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>No Barang</th>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>Tanggal Pengajuan</th>
            <th>Dari tanggal</th>
            <th>Sampai tanggal</th>
            {{-- <th>Status</th> --}}
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp 
        @foreach( $peminjaman as $key => $m )

            @php
                $data = $m->peminjamans;
            @endphp

            @foreach ($data as $k => $d)
                @php
                    $changed = $d->peminjaman;
                    $d = !empty($changed) ? $changed : $d;
                @endphp

                @if ( !empty($d->confirmed_at) )
                    @php
                        $item = $d->item;
                    @endphp
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $m->peminjamanable_type == "App\PeminjamanDetail" ?
                                $m->peminjamanable->peminjamanable->user->name :
                                $m->user->name
                            }}
                        </td>
                        <td>{{ $item->unique_id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->item->category->category }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td>{{ !empty($m->created_at) ? $m->created_at->isoFormat('DD MMMM YYYY') : '-' }}</td>
                        <td>{{ !empty($d->date_start) ? $d->date_start->isoFormat('DD MMMM YYYY') : '-' }}</td>
                        <td>{{ !empty($d->date_end) ? $d->date_end->isoFormat('DD MMMM YYYY') : '-' }}</td>
                        {{-- <td>{{ !empty($d->status) ? $d->status[0] : 'belum dikonfirmasi'}}</td> --}}
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>

@endsection