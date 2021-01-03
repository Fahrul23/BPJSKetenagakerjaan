@extends('layouts.master')

@section('title', 'Tambah Barang Aset')

@section('content')

    <section class="section">

        <div class="section-header">
            <div class="section-header-back d-md-none">
                <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1 class="d-xl-none d-md-none">Barang Aset</h1>
            <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
                <div class="breadcrumb-item active"><a href="{{ route('panel') }}">Home</a></div>
                <div class="breadcrumb-item"><a href="{{route('barang.pinjam.index')}}"> Barang Aset</a>
            </div>
                <div class="breadcrumb-item">Tambah</div>
            </div>
        </div>
    
        @if ( $errors->any() )
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Gagal menambahkan data barang pinjam!
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
                    @component('components.subnav.barang_pinjam')
                        @slot('active')
                            tambah
                        @endslot
                    @endcomponent
                </div>

            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Barang</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            
                            <div class="card-body">

                                @csrf
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="img-upload form-control">
                                            <div class="img">
                                                <div class="text"><i class="fas fa-upload"></i></div>
                                            </div>
                                            <input class="uploader" name="image" type="file" accept="image/*">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ ucfirst($message) }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ ucfirst($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Stok</label>
                                                    <input class="form-control @error('stock') is-invalid @enderror" type="number" name="stock" min="1" value="{{ old('stock') }}">
                                                    @error('stock')
                                                        <div class="invalid-feedback">
                                                            {{ ucfirst($message) }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Kategori</label>
                                                    <select class="form-control @error('category') is-invalid @enderror" name="category">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($category as $c)
                                                            <option value="{{ $c->id }}" @if( $c->id == old('category') ) selected @endif>{{ $c->category }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <div class="invalid-feedback">
                                                            {{ ucfirst($message) }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Tambah</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
    
    <script src="{{ asset('js/image-uploader.js') }}"></script>

    <script>
        $(document).ready(function() {
            horiscroll($('.scroller'));
        })
    </script>

@endsection