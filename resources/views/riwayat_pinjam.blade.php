@extends('layouts.master')

@section('title', 'Riwayat Peminjaman')

@section('content')
<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Riwayat Peminjaman</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item">Riwayat Peminjaman</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">

            <div class="col-md-12">
                <form method="get">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-custom btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collapse" id="mycard-collapse">
                            <div class="card-body">
                                <div class="row">

                                    @can('admin')
                                        <div class="col-12 col-sm-12">
                                        <!-- cari produk -->
                                            <div class="form-group">
                                                <label class="d-block">Nama</label>
                                                <select class="form-control" name="user">
                                                    <option value="">Semua</option>
                                                    @foreach( $users as $user )
                                                        <option {{ request()->get('user') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endcan

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="d-block">Dari tanggal</label>
                                            <input type="date" name="start" class="form-control" value="{{ request()->get('start') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="d-block">Sampai tanggal</label>
                                            <input type="date" name="end" class="form-control" value="{{ request()->get('end') }}">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn" type="reset">Reset</button>
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Riwayat Peminjaman</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-1 text-center">
                                
                                @can('admin')
                                    <thead>
                                        <tr>
                                            <th>No. Peminjaman</th>
                                            <th>Nama</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($pinjams as $pinjam)

                                            <tr>
                                                <td>{{ $pinjam->id }}</td>
                                                <td>{{ $pinjam->user->name }}</td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam->created_at ) ? '-' :
                                                        $pinjam->created_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('riwayat.pinjam.show', ['id' => $pinjam->id]) }}" class="btn btn-primary">Detail</a>

                                                    <a href="{{ route('riwayat.pinjam.cetak', ['id' => $pinjam->id]) }}" class="btn btn-success">Cetak</a>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="empty-state text-capitalize" data-height="400" style="min-height: 400px;">
                                                        <div class="empty-state-icon">
                                                            <i class="fas fa-question"></i>
                                                        </div>
                                                        <h2>Tidak ditemukan riwayat peminjaman!</h2>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                @endcan

                                @can('user')

                                    <thead>
                                        <tr>
                                            <th>No. Peminjaman</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Tanggal Ubah</th>
                                            {{-- <th>Tanggal Hapus</th> --}}
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($pinjams as $pinjam)

                                            <tr>
                                                <td>{{ $pinjam->id }}</td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam->created_at ) ? '-' :
                                                        $pinjam->created_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                <td>
                                                    {{ 
                                                        empty( $pinjam->updated_at ) ? '-' :
                                                        $pinjam->updated_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td>
                                                {{-- <td>
                                                    {{ 
                                                        empty( $pinjam->delete_at ) ? '-' :
                                                        $pinjam->delete_at->isoFormat('DD MMMM YYYY') 
                                                    }}
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route('riwayat.pinjam.show', ['id' => $pinjam->id]) }}" class="btn btn-primary">Detail</a>

                                                    <a href="{{ route('riwayat.pinjam.cetak', ['id' => $pinjam->id]) }}" class="btn btn-success">Cetak</a>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="empty-state text-capitalize" data-height="400" style="min-height: 400px;">
                                                        <div class="empty-state-icon">
                                                            <i class="fas fa-question"></i>
                                                        </div>
                                                        <h2>Tidak ditemukan riwayat peminjaman!</h2>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                @endcan

                            </table>

                        </div>
                    </div>

                    @if ( $pinjams->hasPages() )
                        <div class="card-footer">
                            {{ 
                                $pinjams->appends([
                                    'name' => request()->get('name'),
                                    'start' => request()->get('start'),
                                    'end' => request()->get('end')
                                ])->links() 
                            }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
