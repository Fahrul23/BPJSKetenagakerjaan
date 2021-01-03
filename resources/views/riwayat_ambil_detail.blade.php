@extends('layouts.master')

@section('title', 'Riwayat Pengambilan')

@section('content')
    <section class="section">

        <div class="section-header">
            <div class="section-header-back d-md-none">
            <a href="{{route('riwayat.ambil.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
            <h1 class=" d-xl-none d-md-none">Riwayat Pengambilan Detail</h1>
            <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
                <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
                <div class="breadcrumb-item"><a href="{{route('riwayat.ambil.index')}}">Riwayat Pengambilan</a></div>
                <div class="breadcrumb-item">Riwayat Pengambilan Detail</div>
            </div>
        </div>

        {{-- alert --}}
        @if ( $errors->any() )
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                Gagal mengkonfirmasi barang!
            </div>
        </div>
        @elseif( Session::has('alert') )
        <div class="alert alert-{{ Session::get('alert.0') }} alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ Session::get('alert.1') }}
            </div>
        </div>
        @endif

        <div class="section-body">
            <div class="row">

                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Data Riwayat Pengambilan</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-1 text-center">
                                    <thead>
                                        <tr>
                                            <th>No. Barang</th>
                                            <th>Barang</th>
                                            <th>Gambar</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Pengambilan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ambils->pengambilans()->withTrashed()->get() as $ambil)

                                            @php
                                                $item = $ambil->item;
                                            @endphp

                                            <tr>
                                                <td>{{ $item->unique_id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($item->image) }}" alt="Gambar Barang {{ $item->name }}" width="80">
                                                </td>
                                                <td>{{ "$ambil->quantity $item->unit" }}</td>
                                                <td>
                                                    {{ 
                                                        empty( $ambil->created_at ) ? '-' :
                                                        $ambil->created_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td class="text-capitalize">
                                                @if ( $ambil->status )
                                                    <span class="badge badge-{{ $ambil->status[1] }}">{{ $ambil->status[0] }}</span>
                                                @else
                                                    <span class="badge badge-light">Menunggu konfirmasi</span>
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

            </div>
        </div>
    </section>

@endsection

