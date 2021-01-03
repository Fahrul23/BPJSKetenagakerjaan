@extends('layouts.master')

@section('title', 'Laporan Pengambilan Detail')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{route('laporan_pengambilan')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Laporan Pengambilan Detail</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('laporan_pengambilan')}}">Laporan Pengambilan</a></div>
            <div class="breadcrumb-item">{{ $pengambilans->user->name }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4>Invoice {{ $user->name }}</h4>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($pengambilans->pengambilans()->withTrashed()->get() as $key => $pengambilan)

                                        @php
                                            $item = $pengambilan->item;
                                        @endphp

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><img width="100" class="img-thumbnail" src="{{ Storage::url($item->image) }}" /></td>
                                            <td>{{ $item->category->category }}</td>
                                            <td>{{ "$pengambilan->quantity $item->unit" }}</td>
                                            <td class="text-capitalize">
                                                @if ( $pengambilan->status )
                                                    <span class="badge badge-{{ $pengambilan->status[1] }}">{{ $pengambilan->status[0] }}</span>
                                                @else 
                                                    <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    @empty
                                        <td colspan="5">
                                            <p>Tidak ada data pengambilan barang!</p>
                                        </td>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection