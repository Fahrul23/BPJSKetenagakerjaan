@extends('layouts.master')

@section('title', 'Riwayat Peminjaman')

@section('content')
    <section class="section">

        <div class="section-header">
            <div class="section-header-back d-md-none">
            <a href="{{route('riwayat.pinjam.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
            <h1 class=" d-xl-none d-md-none">Riwayat Peminjaman Detail</h1>
            <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
                <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
                <div class="breadcrumb-item"><a href="{{route('riwayat.pinjam.index')}}">Riwayat Peminjaman</a></div>
                <div class="breadcrumb-item">Riwayat Peminjaman Detail</div>
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
                            <h4>Data Riwayat Peminjaman</h4>
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
                                        @foreach ($pinjams as $pinjam)
                                            <tr>
                                                <td>{{ $pinjam->item_unique_id }}</td>
                                                <td>{{ $pinjam->item_name }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($pinjam->item_image) }}" alt="Gambar Barang {{ $pinjam->item_name }}" width="80">
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

                @foreach ($pinjams as $pinjam)
                    
                    @if ( !empty($pinjam->ganti) )
                            
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        Barang <span class="badge badge-default">{{ $pinjam->item_name }}</span> Diganti <span class="badge badge-default">{{ $pinjam->ganti->item_name }}</span>
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
                                                    <td>{{ $pinjam->ganti->item_unique_id }}</td>
                                                    <td>{{ $pinjam->ganti->item_name }}</td>
                                                    <td>
                                                        <img src="{{ Storage::url($pinjam->ganti->item_image) }}" alt="Gambar Barang {{ $pinjam->ganti->item_name }}" width="80">
                                                    </td>
                                                    <td>{{ $pinjam->ganti->keterangan }}</td>
                                                    <td>
                                                        {{ 
                                                            empty( $pinjam->ganti->date_start ) ? '-' :
                                                            $pinjam->ganti->date_start->isoFormat('DD MMMM YYYY') 
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ 
                                                            empty( $pinjam->ganti->date_end ) ? '-' :
                                                            $pinjam->ganti->date_end->isoFormat('DD MMMM YYYY') 
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ 
                                                            empty( $pinjam->ganti->confirmed_at ) ? '-' :
                                                            $pinjam->ganti->confirmed_at->isoFormat('DD MMMM YYYY') 
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ 
                                                            empty( $pinjam->ganti->returned_at ) ? '-' :
                                                            $pinjam->ganti->returned_at->isoFormat('DD MMMM YYYY') 
                                                        }}
                                                    </td>
                                                    <td class="text-capitalize">
                                                        @if ( $pinjam->ganti->status )
                                                            <span class="badge badge-{{ $pinjam->ganti->status[1] }}">{{ $pinjam->ganti->status[0] }}</span>
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


@section('script')

<script>

    function alertDelete(e, type = false) {
        let setup = {
            title: 'Kamu yakin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }
        if (type) {
            setup.text = 'Data yang sudah dihapus permanen akan hilang selamanya!';
        }
        Swal.fire(setup).then((result) => {
            console.log(result)
            if (result.value) {
                e.submit();
            }
        });
    }

</script>

@endsection