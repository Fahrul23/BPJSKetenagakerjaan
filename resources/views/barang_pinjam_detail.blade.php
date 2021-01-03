 @extends('layouts.master')

@section('title', 'Barang Aset Detail')

@section('content') 

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{route('barang.pinjam.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="d-xl-none d-md-none">Barang Pinjam Detail</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{route('barang.pinjam.index')}}">Barang Aset</a></div>
            {{-- <div class="breadcrumb-item">Pinjam</div> --}}
            <div class="breadcrumb-item">Detail</div>
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
                <h4>{{ $item->name }}</h4>
                <div class="card-header-action">
                    <a class="btn btn-custom btn-icon btn-primary btn-custom-add" href="#">
                        <i class="fas fa-plus"></i>
                        <form action="{{ route('barang.pinjam.tambah.item') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                        </form>
                    </a>
                    <a class="btn btn-custom btn-icon btn-warning" href="#" data-toggle="modal" data-target="#btn-custom-change">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-custom btn-icon btn-danger btn-delete" href="#">
                        <i class="fas fa-trash"></i>
                        <form action="{{ route('barang.pinjam.delete', ['id' => $item->id]) }}" method="post">
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
                                <div>{{ $item->items->count() }}</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
            
        @foreach ($details as $key => $value)
            <div class="card">
                <div class="card-header">
                    <h4>{{ $value->unique_id }}</h4>
                    <div class="card-header-action">
                        <a class="btn btn-custom btn-icon btn-primary" data-collapse="#collapse{{ $key }}" href="#"><i class="fas fa-plus"></i></a>
                        <a class="btn btn-custom btn-icon btn-warning modal-custom-button" data-toggle="modal" data-target="#modal-custom-{{ $key }}" href="#"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-custom btn-icon btn-danger btn-delete" href="#">
                            <i class="fas fa-trash"></i>
                            <form action="{{ route('barang.pinjam.delete.item', ['id' => $value->id]) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="collapse{{ $key }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">No. Barang</label>
                                <p>{{ $value->unique_id }}</p>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="">Status</label>
                                <p>
                                    <span class="badge badge-{{ $value->status ? "primary" : "danger" }}">
                                        {{ $value->status ? 'Tersedia' : 'Tidak ada' }} 
                                    </span>
                                </p>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">Kondisi Barang</label>
                                @php
                                    switch ($value->condition) {
                                        case "bagus":
                                            $badge = 'primary';
                                            break;

                                        case "rusak":
                                            $badge = 'danger';
                                            break;

                                        case "hilang":
                                            $badge = 'warning';
                                            break;
                                    }
                                @endphp
                                <p class="text-capitalize">
                                    <span class="badge badge-{{ $badge }} ">{{ $value->condition }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Tanggal Buat</label>
                                <p>{{ $value->created_at->isoFormat('DD MMMM YYYY') }}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Terakhir Update</label>
                                <p>{{ $value->updated_at->isoFormat('DD MMMM YYYY') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach

    </div>
    
</section>

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
                                <div>{{ $item->items->count() }}</div>
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

{{--
  +  Modals
  +
  +  Modal elemen yang digunakan di 
  +  Tampilan ini.
  +
  --}}

@foreach ($details as $key => $value)

    <div class="modal modal-custom fade" id="modal-custom-{{ $key }}">
        <form action="{{ route('barang.pinjam.update.status') }}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{ $value->id }}">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update kondisi barang ( {{ $value->unique_id }} ) ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="selectgroup w-100">
                            @foreach (['bagus', 'rusak', 'hilang'] as $condition)
                                <label class="selectgroup-item">
                                    @php
                                        $checked = ($condition === $value->condition) ? true : false;
                                    @endphp
                                    <input type="radio" name="condition" value="{{ $condition }}" class="selectgroup-input" @if ($checked) checked @endif>
                                    <span class="selectgroup-button">{{ ucfirst($condition) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endforeach

<script src="{{ asset('js/image-uploader.js') }}"></script>
<script>

    $(document).ready(function() {
        horiscroll($('.scroller'));
    })

    $('.btn-delete').click(function(e) {
        e.preventDefault();
        alertDelete($(this).find('form'));
    })

    $('.btn-custom-add').click(function(e) {
        e.preventDefault();
        alertAdd($(this).find('form'));
    })

    function alertDelete(e, type = false) {
        let setup = {
            title: 'Kamu yakin mau hapus barang ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }
        // if (type) {
        //     setup.text = 'Data yang sudah dihapus permanen akan hilang selamanya!';
        // }
        Swal.fire(setup)
        .then((result) => {
            if (result.value) {
                e.submit();
            }
        });
    }

    function alertAdd(e) {
        let setup = {
            title: 'Apakah anda ingin menambahkan barang baru?',
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