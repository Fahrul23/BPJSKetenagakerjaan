@extends('layouts.master')

@section('title')
    Detail Barang Consumable
@endsection

@section('content')
    
    <div class="section">

        <div class="section-header">
            <div class="section-header-back d-md-none">
                <a href="{{route('barang.pinjam.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1 class="d-xl-none d-md-none">Barang Consumeable Detail</h1>
            <div class="section-header-breadcrumb ml-sm-0 d-none d-md-flex text-capitalize">
                <div class="breadcrumb-item active"><a href="{{route('panel')}}">home</a></div>
                <div class="breadcrumb-item"><a href="{{route('barang.ambil.index')}}">barang consumable</a></div>
                {{-- <div class="breadcrumb-item"><a href="{{route('barang.ambil.index')}}">ambil</a></div> --}}
                <div class="breadcrumb-item">{{ $item->name }}</div>
            </div>
        </div>

        <div class="section-body">

            {{-- alert --}}

            @if ( $errors->any() )
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Gagal, terjadi kesalahan pada sistem!
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

            <div class="card">
                <div class="card-header">
                    <h4>Detail Barang</h4>
                    <div class="card-header-action">
                        {{-- <a class="btn btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a> --}}
                        <a class="btn btn-custom btn-icon btn-warning" href="#" data-toggle="modal" data-target="#btn-custom-change">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-custom btn-icon btn-danger btn-delete" href="#">
                            <i class="fas fa-trash"></i>
                            <form action="{{ route('barang.ambil.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </div>
                    {{-- <button class="btn btn-primary trigger--fire-modal-1 modal-custom">Launch Modal</button> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ Storage::url($item->image) }}" style="width:100%">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Kategori</label>
                                    <div>{{ $item->category->category }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Tanggal Buat</label>
                                    <div>{{ $item->created_at->isoFormat('DD MMMM YYYY') }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Jumlah Barang</label>
                                    <div>{{ $item->stock }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Unit</label>
                                    <div>{{ $item->unit }}</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="btn-custom-change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">update barang {{ $item->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" enctype="multipart/form-data">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ Storage::url($item->image) }}" alt="Barang {{ $item->name }}" style="width: 100%;">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Nama barang</label>
                                    <div>{{ $item->name }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <div>{{ $item->category->category }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <div>{{ $item->stock }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="">Unit</label>
                                    <div>{{ $item->unit }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="">Nama barang</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tambah Jumlah</label>
                                            <input type="text" name="stock" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Unit</label>
                                            <input type="text" name="unit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Gambar</label>
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
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="{{ asset('js/image-uploader.js') }}"></script>
    <script>

        $(document).ready(function() {
            horiscroll($('.scroller'));

            $('.btn-delete').click(function() {
                alertDelete($(this).find('form'));
            })
        })

        function alertDelete(e) {
            let setup = {
                title: 'Kamu yakin mau hapus barang ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak'
            }
            Swal.fire(setup)
            .then((result) => {
                if (result.value) {
                    e.submit();
                }
            });
        }

    </script>

@endsection