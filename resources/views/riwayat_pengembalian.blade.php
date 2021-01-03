@extends('layouts.master')

@section('title', 'Riwayat Pengembalian')

@section('content')
<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class=" d-xl-none d-md-none">Riwayat Pengembalian</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item">Riwayat Pengembalian</div>
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
                        <h4>Pengembalian Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>

                                    <tr>
                                        <th>No.</th>

                                        @can('admin')
                                            <th>Nama User</th>
                                        @endcan

                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        <th>Dikembalikan Pada</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($peminjaman as $key => $m)
                                    <tr>
                                        <td>{{$key + 1}}</td>

                                        @can('admin')
                                            <td>{{$m->name}}</td>
                                        @endcan
                                        
                                        <td>{{$m->barang}}</td>
                                        <td>
                                            <img width="100" class="img-thumbnail" src="{{ Storage::url($m->image) }}" />
                                        </td>
                                        <td>{{$m->category}}</td>
                                        <td>{{ !empty($m->date_start) ? $m->date_start->isoFormat('DD MMMM YYYY') : '-' }}</td>
                                        <td>{{ !empty($m->date_end) ? $m->date_end->isoFormat('DD MMMM YYYY') : '-' }}</td>

                                        <td>{{ !empty($m->returned_at) ? $m->returned_at : '-' }}</td>

                                        @can('admin')
                                        
                                        {{-- <td>
                                            <span class="badge badge-{{ !empty($m->date_end) && \Carbon\Carbon::now()->lt($m->date_end) &&!$m->date_end->isToday() ? 'success' : 'danger' }}">
                                                @php
                                                    // jika batas pinjamnya hari ini
                                                    if ($m->date_end->isToday())
                                                    $sisa_waktu = 'Hari Ini';
                                                    // jika batas pinjam masih lama
                                                    else if (\Carbon\Carbon::now()->lt($m->date_end))
                                                    $sisa_waktu = now()->diffInDays($m->date_end) . ' ' . 'Hari';
                                                    // jika lewat dari batas pinjam
                                                    else 
                                                    $sisa_waktu = 'Habis';
                                                @endphp
                                                
                                                {{ $sisa_waktu}}
                                            </span>
                                        </td> --}}
                                        <td>
                                            <a href="{{route('riwayat.kembali.kondisi', ['id' => $m->items_id])}}" class="btn btn-info">Konfirmasi</a>
                                        </td>

                                        @endcan

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengembalian Barang Ganti</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        @can('admin')
                                        <th>Nama User</th>
                                        @endcan
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        @can('user')
                                        <th>Dikembalikan Pada</th>
                                        @endcan
                                        @can('admin')
                                        <th>Sisa Waktu</th>
                                        <th>Kondisi Barang</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman_ganti as $key => $ganti)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        @can('admin')
                                        <td>{{$ganti->name}}</td>
                                        @endcan
                                        <td>{{$ganti->ganti->name}}</td>
                                        <td><img width="100" class="img-thumbnail" src="{{ Storage::url($ganti->ganti->image) }}" /></td>
                                        <td>{{$ganti->ganti->category}}</td>
                                        <td>{{ !empty($ganti->date_start) ? $ganti->date_start : '-' }}</td>
                                        <td>{{ !empty($ganti->date_end) ? $ganti->date_end : '-' }}</td>
                                        @can('user')
                                        <td>{{ $ganti->returned_at }}</td>
                                        @endcan
                                        @can('admin')
                                        
                                        <td>
                                            <span class="badge badge-{{ !empty($ganti->date_end) && \Carbon\Carbon::now()->lt($ganti->date_end) &&!$ganti->date_end->isToday() ? 'success' : 'danger' }}">
                                                @php
                                                    // jika batas pinjamnya hari ini
                                                    if ($ganti->date_end->isToday())
                                                    $sisa_waktu = 'Hari Ini';
                                                    // jika batas pinjam masih lama
                                                    else if (\Carbon\Carbon::now()->lt($ganti->date_end))
                                                    $sisa_waktu = now()->diffInDays($ganti->date_end) . ' ' . 'Hari';
                                                    // jika lewat dari batas pinjam
                                                    else 
                                                    $sisa_waktu = 'Habis';
                                                @endphp
                                                
                                                {{ $sisa_waktu}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{route('riwayat.kembali.kondisi', ['id' => $ganti->ganti->items_id])}}" class="btn btn-info">Konfirmasi</a>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
</section>

@endsection


@section('script')

<script src="{{asset('js/page/modules-datatables.js')}}"></script>


@endsection