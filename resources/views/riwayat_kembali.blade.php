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
                                        <th>No. Peminjaman</th>

                                        @can('admin')
                                            <th>Nama</th>
                                        @endcan

                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        {{-- <th>Status</th> --}}

                                        @can('admin')
                                            <th></th>
                                        @endcan
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse( $peminjaman as $key => $m )

                                        @php
                                            
                                            $data = $m->peminjamans;

                                        @endphp

                                        @foreach ($data as $k => $d)
                                            
                                            @php
                                                $changed = $d->peminjaman;
                                                $d = !empty($changed) ? $changed : $d;
                                            @endphp

                                            @if ( !empty($d->confirmed_at) && empty($d->returned_at) )
                                                
                                                @php
                                                    $item = $d->item;
                                                @endphp

                                                <tr>
                                                    <td>{{ $d->id }}</td>

                                                    @can('admin')
                                                        <td>
                                                            {{ 
                                                                $m->peminjamanable_type == "App\PeminjamanDetail" ?
                                                                $m->peminjamanable->peminjamanable->user->name :
                                                                $m->user->name
                                                            }}
                                                        </td>
                                                    @endcan
                                                    
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <img width="100" class="img-thumbnail" src="{{ Storage::url($item->image) }}" />
                                                    </td>
                                                    <td>{{ $item->item->category->category }}</td>
                                                    <td>{{ !empty($d->date_start) ? $d->date_start->isoFormat('DD MMMM YYYY') : '-' }}</td>
                                                    <td>{{ !empty($d->date_end) ? $d->date_end->isoFormat('DD MMMM YYYY') : '-' }}</td>
                                                    {{-- <td>
                                                        @if ( $d->date_start->lessThan($d->date_end) )
                                                            <span class="badge badge-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-danger">Nonaktif</span>
                                                        @endif
                                                    </td> --}}

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
                                                        <a href="{{route('riwayat.kembali.kondisi', ['id' => $d->items_id])}}" class="btn btn-primary">Konfirmasi</a>
                                                    </td>

                                                    @endcan

                                                </tr>

                                            @endif

                                        @endforeach

                                    @empty

                                        <tr>
                                            <td colspan="7">
                                                <div class="empty-state text-capitalize" data-height="400" style="min-height: 400px;">
                                                    <div class="empty-state-icon">
                                                        <i class="fas fa-question"></i>
                                                    </div>
                                                    <h2>Semua barang sudah dikembalikan!</h2>
                                                </div>
                                            </td>
                                        </tr>
                                    
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