@extends('layouts.master')

@section('title', 'Laporan Peminjaman Detail')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{route('laporan_peminjaman')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Laporan Peminjaman Detail</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('laporan_peminjaman')}}">Laporan Peminjaman</a></div>
            <div class="breadcrumb-item">Laporan Peminjaman Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Detail Peminjaman</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No. Barang</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Pelaksanaan</th>
                                        <th>Akhir Pelaksanaan</th>
                                        <th>Tanggal Konfirmasi</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pinjams->peminjamans()->withTrashed()->get() as $pinjam)
                                        <tr>
                                            <td>{{ $pinjam->item->unique_id }}</td>
                                            <td>{{ $pinjam->item->name }}</td>
                                            <td>
                                                <img src="{{ Storage::url($pinjam->item->image) }}" alt="Gambar Barang {{ $pinjam->item->name }}" width="80">
                                            </td>
                                            <td>{{ $pinjam->keterangan }}</td>
                                            <td>
                                                {{ 
                                                    empty( $pinjam->date_start ) ? '-' :
                                                    $pinjam->date_start->isoFormat('DD MMMM YYYY') 
                                                }}
                                            </td>
                                            <td>
                                                {{ 
                                                    empty( $pinjam->date_end ) ? '-' :
                                                    $pinjam->date_end->isoFormat('DD MMMM YYYY') 
                                                }}
                                            </td>
                                            <td>
                                                {{ 
                                                    empty( $pinjam->confirmed_at ) ? '-' :
                                                    $pinjam->confirmed_at->isoFormat('DD MMMM YYYY') 
                                                }}
                                            </td>
                                            <td>
                                                {{ 
                                                    empty( $pinjam->returned_at ) ? '-' :
                                                    $pinjam->returned_at->isoFormat('DD MMMM YYYY') 
                                                }}
                                            </td>
                                            <td class="text-capitalize">
                                                @if ( $pinjam->status )
                                                    <span class="badge badge-{{ $pinjam->status[1] }}">{{ $pinjam->status[0] }}</span>
                                                @else 
                                                    <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            @foreach ($pinjams->peminjamans()->withTrashed()->get() as $pinjam)
                
                @php
                    $pinjam_change = $pinjam->peminjaman;
                @endphp

                @if ( !empty($pinjam_change) )
                        
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    Barang <span class="badge badge-default">{{ $pinjam->item->name }}</span> Diganti <span class="badge badge-default">{{ $pinjam_change->item->name }}</span>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-1 text-center">
                                        <thead>
                                            <tr>
                                                <th>No. Barang</th>
                                                <th>Barang</th>
                                                <th>Gambar</th>
                                                <th>Alasan ganti</th>
                                                <th>Tanggal Pelaksanaan</th>
                                                <th>Akhir Pelaksanaan</th>
                                                <th>Tanggal Konfirmasi</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $pinjam_change->item->unique_id }}</td>
                                                <td>{{ $pinjam_change->item->name }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($pinjam_change->item->image) }}" alt="Gambar Barang {{ $pinjam_change->name }}" width="80">
                                                </td>
                                                <td>{{ $pinjam_change->keterangan }}</td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam_change->date_start ) ? '-' :
                                                        $pinjam_change->date_start->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam_change->date_end ) ? '-' :
                                                        $pinjam_change->date_end->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam_change->confirmed_at ) ? '-' :
                                                        $pinjam_change->confirmed_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam_change->returned_at ) ? '-' :
                                                        $pinjam_change->returned_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td class="text-capitalize">
                                                    @if ( $pinjam_change->status )
                                                        <span class="badge badge-{{ $pinjam_change->status[1] }}">{{ $pinjam_change->status[0] }}</span>
                                                    @else 
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

            @endforeach
        </div>
    </div>
</section>

@endsection
