@extends('layouts.master')

@section('title', 'Konfirmasi Pengembalian')

@section('content')
<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('riwayat.kembali.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="d-xl-none d-md-none">Konfirmasi Pengembalian</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active">
              <a href="{{ route('panel') }}">Home</a>
            </div>

            <div class="breadcrumb-item active">
              <a href="{{ route('riwayat.kembali.index') }}" class="text-capitalize">Riwayat Pengembalian</a>
            </div>

            <div class="breadcrumb-item">Konfirmasi Pengembalian </div>
        </div>
    </div>

    {{-- alert --}}
    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            Gagal mengembalikan barang!
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
                    {{-- <div class="card-header">
                        <div class="col-md-12">

                        </div>
                    </div> --}}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-sm-12 mb-2">
                                <img class="mr-3 img-thumbnail mb-2" style="border: none; !important" width="450" height="350" src="{{ Storage::url($kondisi_barang->image) }}" alt="Image barang {{ $kondisi_barang->name }}">
                            </div>

                            <div class="col-xl-8 col-md-8 col-sm-12">
                              <h3 class="mt-2 mb-2 text-primary">{{ "$kondisi_barang->name ($kondisi_barang->unique_id)" }}</h3>
                              <form action="{{route('riwayat.kembali.return')}}" method="post">
                              @csrf
                                <div class="form-group">
                                  <label class="d-block">Kondisi Barang</label>
                                  <select class="form-control @error('kondisi_barang') is-invalid @enderror" name="kondisi_barang">
                                    <option value="">Pilih Kondisi</option>
                                    <option value="bagus">Bagus</option>
                                    <option value="rusak">Rusak</option>
                                    <option value="hilang">Hilang</option>
                                  </select>
                                  @error('kondisi_barang')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                  @enderror
                                </div>
                              <div class="card-footer text-right" style="padding-right: 0;">
                                <input type="hidden" name="items_id" value="{{ $kondisi_barang->items_id }}">
                                <button class="btn btn-primary text-capitalize" type="submit">Submit</button>
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

