@extends('template.exports.stylePDF')

@section('laporan')
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Quantity</th>
            <th>Satuan</th>
            <th>Tanggal Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengambilan as $key => $m)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $m->name }}</td>
            <td>{{ $m->barang }}</td>
            <td>{{ $m->category }}</td>
            <td>{{ $m->quantity }}</td>
            <td>{{ $m->unit }}</td>
            <td>{{ !empty($m->created_at) ? $m->created_at->isoFormat('dddd, D MMMM Y') : '-' }}</td>
        </tr>
        @endforeach
    </tbody>

@endsection