@extends('layouts.master')

@section('title', 'Konfirmasi Pengambilan')

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('konfirmasi_pengambilan') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Konfirmasi Pengambilan Detail</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_pengambilan')}}">Konfirmasi Pengambilan</a></div>
            <div class="breadcrumb-item">Konfirmasi Pengambilan Detail</div>
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
                        <h4>Invoice {{ $ambils->user->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        {{-- <th>No.</th> --}}
                                        <th></th>
                                        <th>Nama barang</th>
                                        <th>Jumlah</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($ambils->pengambilans()->whereNull('confirmed_at')->get() as $ambil)
                                        @php
                                            $item = $ambil->item;
                                        @endphp
                                        <tr>
                                            {{-- <td>{{$key + 1}}</td> --}}
                                            <td>
                                                <img width="100" src="{{ Storage::url($item->image) }}" alt="Gambar Barang {{ $item->name }}">
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$ambil->quantity}} {{$item->unit}}</td>

                                            <td class="d-flex align-items-center" style="cursor: pointer">
                                                <span role="button" class="btn btn-success ml-1" onclick="$(this).find('form').submit()" data-toggle="tooltip" data-placement="top" title="Konfirmasi">
                                                    <i class="fas fa-check"></i>
                                                    <form action="{{ route('konfirmasi_pengambilan_konfirmasi') }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="id" value="{{ $ambil->id }}">
                                                    </form>
                                                </span>

                                                <span role="button" class="btn btn-danger ml-1" onclick="$(this).find('form').submit()" data-toggle="tooltip" data-placement="top" title="Tolak">
                                                    <i class="far fa-trash-alt"></i>
                                                    <form action="{{ route('konfirmasi_pengambilan_hapus', ['id' => $ambil->id]) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </span>
                                            </td>

                                        </tr>
                                    @empty
                                        <td colspan="5">
                                            <p>Tidak ada data pemesanan!</p>
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

