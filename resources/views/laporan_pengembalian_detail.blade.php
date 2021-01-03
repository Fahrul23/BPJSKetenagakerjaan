@extends('layouts.master')

@section('title', 'Laporan Pengembalian Detail')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{route('laporan_pengembalian')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Laporan Pengembalian Detail</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('laporan_pengembalian')}}">Laporan Pengembalian</a></div>
            <div class="breadcrumb-item">Laporan Pengembalian Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Invoice {{ $user->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Batas Pinjam</th>
                                        <th>Dikembalikan Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ( $pengembalian_detail->isEmpty() )
                                        <td colspan="9">
                                            <p>Tidak ada data pemesanan!</p>
                                        </td>
                                    @else
                                        @foreach($pengembalian_detail as $key => $m)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$m->name}}</td>
                                                <td><img width="100" class="img-thumbnail" src="{{ Storage::url($m->image) }}" /></td>
                                                <td>{{$m->category}}</td>
                                                <td>{{ $m->date_start->isoFormat('dddd, D MMMM Y') }}</td>
                                                <td>{{ $m->date_end->isoFormat('dddd, D MMMM Y') }}</td>
                                                <td>{{$m->returned_at->isoFormat('dddd, D MMMM Y')}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-12">
                @foreach ($pengembalian_ganti as $key => $ganti)
                    <div class="card">
                        <div class="card-header">
                            <h4>Ganti Barang {{ $ganti->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-1 text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Detail Barang</th>
                                            <th>Gambar</th>
                                            <th>Qty</th>
                                            <th>Kategori</th>
                                            <th>Alasan Ganti</th>
                                            <th>Dari tanggal</th>
                                            <th>Sampai tanggal</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td class="p-2">{{$ganti->ganti->name}}</td>
                                            <td><img width="100" class="img-thumbnail" src="{{ Storage::url($ganti->ganti->image) }}" /></td>
                                            <td>1</td>
                                            <td>{{$ganti->ganti->category}}</td>
                                            <td>{{$ganti->ganti->keterangan}}</td>
                                            <td>{{$ganti->ganti->date_start->isoFormat('dddd, D MMMM Y')}}</td>
                                            <td>{{$ganti->ganti->date_end->isoFormat('dddd, D MMMM Y')}}</td>
                                            <td class="d-flex align-items-center" style="cursor: pointer">
                                                <span role="button" class="btn btn-success ml-1" onclick="$(this).find('form').submit()" data-toggle="tooltip" data-placement="top" title="Konfirmasi">
                                                    <i class="fas fa-check"></i>
                                                    <form action="{{route('konfirmasi_peminjaman_tambah_ganti')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $ganti->ganti->id }}">
                                                    </form>
                                                </span>

                                                <span role="button" class="btn btn-danger ml-1" onclick="$(this).find('form').submit()" data-toggle="tooltip" data-placement="top" title="Tolak">
                                                    <i class="far fa-trash-alt"></i>
                                                    <form action="{{route('konfirmasi_peminjaman_hapus_item')}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $ganti->ganti->id }}">
                                                    </form>
                                                </span>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{asset('js/page/modules-datatables.js')}}"></script>
@endsection