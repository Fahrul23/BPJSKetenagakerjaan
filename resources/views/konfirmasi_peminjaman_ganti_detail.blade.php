@extends('layouts.master')

@section('title', 'Detail Barang')

@section('content')
<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
        <a href="{{route('konfirmasi_peminjaman_ganti', ['id' => $peminjaman_detail_id])}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class="d-xl-none d-md-none">Detail Barang</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman')}}">Konfirmasi Peminjaman</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman_detail', ['id' => $peminjaman_id])}}">Konfirmasi Peminjaman Detail</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman_ganti', ['id' => $peminjaman_detail_id])}}">Ubah Barang</a></div>
            {{-- <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman_ganti_item', ['id' => $item->id])}}">Barang</a></div> --}}
            <div class="breadcrumb-item">{{$item_detail->unique_id}}</div>
        </div>
    </div>

    {{-- alert --}}
    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            Gagal mengganti barang!
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
                    <div class="card-body">
                        {{-- <div class="row mb-3">
                            <div class="col-12 mb-2">
                                
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-sm-12 mb-2">
                                <img class="mr-3 img-thumbnail" width="450" src="{{ Storage::url($item_detail->image) }}" alt="Image barang {{ $item_detail->name }}">
                            </div>
                            <div class="col-xl-8 col-md-8 col-sm-12">
                                <h3 class="mt-2 mb-2 text-primary">{{"$item_detail->name ($item_detail->unique_id)"}}</h3> 
                                <form action="{{route('konfirmasi_peminjaman_ganti_barang')}}" method="post">
                                @csrf
                                    <input type="hidden" name="item_id" value="{{ $item_detail->id }}">
                                    <input type="hidden" name="peminjaman_id" value="{{ $peminjaman_id }}">
                                    <input type="hidden" name="peminjaman_detail_id" value="{{ $peminjaman_detail_id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Keterangan Ganti</label>
                                                <input type="text" class="form-control @error('keterangan_ganti') is-invalid @enderror" value="{{ old('keterangan_ganti') }}" name="keterangan_ganti">
                                                @error('keterangan_ganti')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary text-capitalize"><i class="far fa-edit"></i> Ganti Barang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

    <script>
        $('.form-activity-item').each(function(i, e) {
            $('.type-input').each(function(i, f) {
                if ( $(f).is(':checked') ) {
                    $(e).hide()
                    if ( $(e).attr('data-activity') == $(f).val() ) $(e).show()
                } 
            })
        })
        $('.selectgroup-type').click(function(e) {
            $('.form-activity-item').hide()
            $('select[name=user]').val()
            $('input[name=user]').prop('checked', false)
            $('.form-activity').find('[data-activity="'+$(this).attr('data-type')+'"]').show()
        })
    </script>

@endsection