@extends('layouts.master')

@section('title')
{{ $judul }}
@endsection

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class="text-capitalize">{{ Route::currentRouteName() == 'ambil' ? 'Pengambilan' : 'Peminjaman' }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item">{{ Route::currentRouteName() == 'ambil' ? 'Pengambilan' : 'Peminjaman' }}</div>

        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <form action="{{route($search)}}">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#" style="width: 32px; height: 32px; display: flex; justify-content: center; align-items: center;"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collapse" id="mycard-collapse" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <!-- cari produk -->
                                        <label for="">Cari</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search" value="{{ request()->get('search') }}" placeholder="Cari Barang">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!-- kategori -->
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
            <div class="col-12">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h4>Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ( count($item) > 0 )
                                @foreach($item as $barang)
                                <a @if($barang->stock > 0) href="{{ route('detail_' . $search, ['id' => $barang->id]) }}" @else onclick="alertStockKosong()" @endif>
                                    <div class="col-sm-6 col-md-3 col-xl-2 ">
                                        <div class="card">
                                            <img class="img-thumbnail mb-2" src="{{ asset("storage/item-image/$barang->image") }}"/>
                                            <a style="color: #6777ef;" @if($barang->stock > 0) href="{{ route('detail_' . $search, ['id' => $barang->id]) }}" @else onclick="alertStockKosong()" @endif>
                                                {!! Str::limit($barang->item, 35, '...') !!}
                                            </a>
                                            <span class="mb-1">{{ $barang->category }}</span>
                                            
                                            <span class="mr-auto d-block mb-3 badge badge-{{ 
                                            $barang->stock < 20 && $barang->type == 'ambil' ? 
                                            'danger' : 
                                            $barang->stock <= 2 && $barang->type == 'pinjam' ? 
                                            'danger' : 'success' }}">{{ $barang->stock > 0 ? $barang->stock . ' ' . 'stok lagi' : 'Stok Habis' }}</span>
                                        </div> 
                                    </div>
                                </a>
                                @endforeach
                                @else
                                <div class="col-12">
                                    <p class="text-center">Tidak ada data barang!</p>
                                </div>
                                @endif
                            </div>
                            {{ $item->appends(['search' => request()->get('search'), 'category' => request()->get('category')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

    <script src="{{asset('js/page/modules-sweetalert.js')}}"></script>
    
@endsection