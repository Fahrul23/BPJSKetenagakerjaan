@extends('layouts.master')

@section('title', 'Konfirmasi Pengambilan')

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Konfirmasi Pengambilan</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item">Konfirmasi Pengambilan</div>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Konfirmasi Pengambilan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($ambils as $key => $ambil)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$ambil->user->name}}</td>
                                            <td>
                                                <a href="{{ route('konfirmasi_pengambilan_detail', ['id' => $ambil->id]) }}" class="btn btn-primary">Detail</a>
                                                {{-- <span class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Detail</span> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="9">
                                            <p>Tidak ada data pemesanan!</p>
                                        </td>
                                    @endforelse

                                    {{-- @if ( $pengambilan->isEmpty() )
                                        <td colspan="9">
                                            <p>Tidak ada data pemesanan!</p>
                                        </td>
                                    @else
                                        @foreach($pengambilan as $key => $m)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$m->name}}</td>
                                            <td>
                                                <a href="{{ route('konfirmasi_pengambilan_detail', ['id' => $m->id]) }}" class="btn btn-info">Detail</a>
                                                <span class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Detail</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="card-body d-block d-sm-none pt-0">

                        @forelse ($ambils as $ambil)
                            <a href="{{route('konfirmasi_peminjaman_detail', ['id' => $ambil->id])}}" style="text-decoration: none;">
                                <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                    <li class="media d-flex p-0 border-bottom">
                                        <div class="col-2 p-0 mr-3">
                                            <img alt="image" class="mr-3 rounded-circle" src="{{ asset('img/avatar/avatar-1.png') }}" width="50">
                                        </div>
                                    
                                        <div class="col-10 p-0">
                                            <div class="media-body text-left">
                                                <div class="media-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$ambil->user->name}}</div>
                                                <div class="text-job text-muted"><i class="far fa-clock"></i> {{ $ambil->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </a>
                        @empty
                            <td colspan="9">
                                <p>Tidak ada data pemesanan!</p>
                            </td>
                        @endforelse
                        
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

