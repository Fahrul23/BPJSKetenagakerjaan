@extends('layouts.master')

@section('title', 'Barang Consumable')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="d-xl-none d-md-none">Barang Consumable</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{ route('panel') }}">Home</a></div>
            <div class="breadcrumb-item">Barang Consumable</div>
        </div>
    </div>

    @component('components.subnav.barang_ambil')
        @slot('active')
            data
        @endslot
    @endcomponent

    @if ( $errors->any() )
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                Gagal menambahkan data!
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
                <form action="">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#" style="width: 32px; height: 32px; display: flex; justify-content: center; align-items: center;"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                          <div class="collapse" id="mycard-collapse" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                        <label for="">Cari</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search" value="{{ request()->get('search') }}" placeholder="Cari Barang">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="">Kategori</label>
                                        <select class="form-control" name="category">
                                            <option value="">Semua</option>
                                            @foreach($category as $kategori)
                                                <option {{ request()->get('category') == $kategori->id ? 'selected' : '' }} value="{{ $kategori->id }}">{{$kategori->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">   
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="grid-custom">
                    {{-- <div class="grid-header">
                        <h4>Data Barang Pinjam</h4>
                    </div> --}}
                    <div class="grid-body">
                        
                        @if ( ! $items->isEmpty() )
                            @foreach ($items as $item)
                                <a href="{{ route('barang.ambil.detail', ['id' => $item->id]) }}" class="grid-card">
                                    <img src="{{ Storage::url($item->image) }}" alt="">
                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ $item->category->category }}</p>
                                    <p class="grid-badge text-capitalize">
                                        @if ( $item->stock > 0 )
                                            <span class="badge badge-primary mr-2">{{ $item->stock }}</span> {{ $item->unit }}
                                        @else
                                            <span class="badge badge-danger">stock habis</span>
                                        @endif
                                    </p>
                                </a>
                            @endforeach
                        @else
                            <p class="text-center empty-msg">Tidak ada data barang!</p>
                        @endif
                        
                    </div>

                    @if( $items->hasPages() )
                        <div class="grid-footer">
                            {{
                                $items->appends([
                                    'search' => request()->get('search'),
                                    'category' => request()->get('category')
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

@section('script')
    
    <script>
        $(document).ready(function() {
            horiscroll($('.scroller'));
        })

        function alertDelete(e, type = false) {
            let setup = {
                title: 'Kamu yakin mau hapus barang ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak'
            }
            if (type) {
                setup.text = 'Data yang sudah dihapus permanen akan hilang selamanya!';
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