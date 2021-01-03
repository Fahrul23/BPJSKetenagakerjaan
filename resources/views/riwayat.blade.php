@extends('layouts.master')

@section('title', 'Riwayat')

@section('content')
<section class="section">

    <div class="section-header">
        <h1>Riwayat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Menu</a></div>
            <div class="breadcrumb-item">Riwayat</div>
            <div class="breadcrumb-item">{{$judul}}</div>
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
        @if($judul == 'Pengembalian')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Barang pengembalian</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Nama</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Tipe Barang</th>
                                        <th>Kategori</th>
                                        <th>Qty</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        @can('admin')
                                        <th>Barang kembali</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($return as $key => $m)
                                    <tr>
                                        <td>
                                            <span class="badge badge-{{ !empty($m->date_end) && $m->date_end->gt(now()) ? 'success' : 'danger' }}">
                                                <i class="fas fa-{{ !empty($m->date_end) && $m->date_end->gt(now()) ? 'check' : 'exclamation' }}"></i>
                                            </span>
                                        </td>
                                        <td>{{$m->name}}</td>
                                        <td>{{$m->item}}</td>
                                        <td><img width="100" class="img-thumbnail" src="storage/item-image/{{$m->image}}" /></td>
                                        <td>
                                            <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }}">{{$m->type}}</span>
                                        </td>
                                        <td>{{$m->category}}</td>
                                        <td>{{$m->quantity}}</td>
                                        <td>{{ !empty($m->date_start) ? $m->date_start->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->date_end) ? $m->date_end->format('l, d F Y') : '-' }}</td>
                                        @can('admin')
                                        <td>
                                            <span class="btn btn-primary" onclick="$(this).find('form').submit()">
                                                Konfirmasi
                                                <form action="{{ route('riwayat_kembali') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $m->id }}">
                                                </form>
                                            </span>
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
        </div>
        @endif

        @if($judul == 'Peminjaman')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Riwayat Peminjaman</h4>
                        @can('admin')
                        <div class="card-header-action">
                            <a href="{{route('export_peminjaman')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
                        </div>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Tipe Barang</th>
                                        <th>Kategori</th>
                                        <th>Qty</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal konfirmasi</th>
                                        <th>Tanggal terima</th>
                                        <th>Tanggal kembali</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activity as $key => $m)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$m->name}}</td>
                                        <td>{{$m->item}}</td>
                                        <td><img width="100" class="img-thumbnail" src="storage/item-image/{{$m->image}}" /></td>
                                        <td>
                                            <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }}">{{$m->type}}</span>
                                        </td>
                                        <td>{{$m->category}}</td>
                                        <td>{{$m->quantity}}</td>
                                        <td>{{ !empty($m->date_start) ? $m->date_start->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->date_end) ? $m->date_end->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->created_at) ? $m->created_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->confirmed_at) ? $m->confirmed_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->received_at) ? $m->received_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->returned_at) ? $m->returned_at->format('l, d F Y') : '-' }}</td>
                                        <td>
                                            <span class="badge badge-{{ empty($m->deleted_at) ? 'success' : 'danger' }}">
                                                {{ !empty($m->deleted_at) ? 'Tolak' : 'Terima' }}
                                            </span>
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
        @endif

        @if($judul == 'Pengambilan')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Riwayat Pengambilan</h4>
                        @can('admin')
                        <div class="card-header-action">
                            <a href="{{route('export_pengambilan')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Tipe Barang</th>
                                        <th>Kategori</th>
                                        <th>Qty</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal konfirmasi</th>
                                        <th>Tanggal terima</th>
                                        <th>Tanggal kembali</th>
                                        <th>Tanggal hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activity as $key => $m)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$m->name}}</td>
                                        <td>{{$m->item}}</td>
                                        <td><img width="100" class="img-thumbnail" src="storage/item-image/{{$m->image}}" /></td>
                                        <td>
                                            <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }}">{{$m->type}}</span>
                                        </td>
                                        <td>{{$m->category}}</td>
                                        <td>{{$m->quantity}}</td>
                                        <td>{{ !empty($m->date_start) ? $m->date_start->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->date_end) ? $m->date_end->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->created_at) ? $m->created_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->confirmed_at) ? $m->confirmed_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->received_at) ? $m->received_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->returned_at) ? $m->returned_at->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->deleted_at) ? $m->deleted_at->format('l, d F Y') : '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection


@section('script')

<script src="{{asset('js/page/modules-datatables.js')}}"></script>
<script>
    $('.selectgroup-input').each(function(i, e) {
        if ($(e).is(':checked')) {
            if ($(e).val() === 'pinjam') $('input[name="stock"]').parent().hide()
        }
})
    $('.selectgroup-item').click(function(e) {
        const stock = $('input[name="stock"]').parent();
        $(this).attr('data-type') === 'pinjam' ? stock.hide() : stock.show();
    })

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