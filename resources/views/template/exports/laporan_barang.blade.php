@extends('template.exports.stylePDF')

@section('laporan')

    <thead>
        <tr>
            <th>No</th>
            <th>No Barang</th>
            <th>Nama Barang</th>
            <th>Tipe Barang</th>
            <th>Kategori Barang</th>
            <th>Stock</th>
            <th>Kondisi Barang</th>
        </tr>
    </thead>
    <tbody>
        @foreach($item as $key => $i)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $i->unique_id }}</td>
            <td>{{ $i->item }}</td>
            <td>{{ $i->type }}</td>
            <td>{{ $i->category }}</td>
            <td>{{ $i->stock }}</td>
            <td>{{ ($i->kondisi_barang) ? $i->kondisi_barang: '-'}}</td>
        </tr>
        @endforeach
    </tbody>

@endsection
