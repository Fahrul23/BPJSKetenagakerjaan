@extends('layouts.master')

@section('title', 'Ubah Barang')

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('konfirmasi_peminjaman_detail', ['id' => $peminjaman_id]) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="d-xl-none d-md-none">Ubah Barang</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman')}}">Konfirmasi Peminjaman</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('konfirmasi_peminjaman_detail', ['id' => $peminjaman_id]) }}">Konfirmasi Peminjaman Detail</a></div>
            <div class="breadcrumb-item">Ubah Barang</div>

        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <form action="{{route('konfirmasi_peminjaman_ganti', ['id' => $peminjaman_id])}}">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-custom btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collapse" id="mycard-collapse" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- cari produk -->
                                        <label for="">Cari</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search" value="{{ request()->get('search') }}" placeholder="Cari Barang">
                                        </div>
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
                {{-- <div class="card-header">
                    <h4>Barang</h4>
                </div> --}}
                <div class="grid-custom">
                    <div class="grid-body">
                        @if ( count($item) > 0 )

                            @foreach($item as $barang)
                                <a class="grid-card" style="cursor: pointer;" onclick="$(this).find('form').submit()">
                                    <form action="{{ route('konfirmasi_peminjaman_ganti_item', ['id' => $barang->id]) }}" method="post">
                                    @csrf
                                        <input type="hidden" name="peminjaman_id" value="{{$peminjaman_id}}">
                                        <input type="hidden" name="peminjaman_detail_id" value="{{$peminjaman_detail_id}}">
                                    </form>
                                    <img src="{{ Storage::url($barang->image) }}"/>
                                    <h5 class="text-primary">{{ $barang->name }}</h5>
                                    <p class="grid-badge"><span>{{ $barang->category->category }}</span></p>
                                    <p class="grid-badge"><span class="badge badge-primary mr-2">{{ $barang->items->count() }}</span> Unit</p>
                                </a>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p class="text-center">Tidak ada data barang!</p>
                            </div>
                        @endif
                    </div>
                    <div class="grid-footer">
                    {{ 
                        $item->appends([
                            'search' => request()->get('search')
                        ])->links() 
                    }}
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <a style="color: #6777ef; cursor: pointer;" @if($barang->stock == 0) onclick="alertStockKosong()" @else onclick="$(this).find('form').submit()" @endif>
                    <img class="img-thumbnail mb-2" src="/storage/item-image/{{$barang->image}}"/>
                                        {!! Str::limit($barang->item, 35, '...') !!}
                    <form action="{{route           ('konfirmasi_peminjaman_ganti_detail', ['id' =>    $barang->id])}}" method="post">
                    @csrf
                        <input type="hidden" name="peminjaman_id" value="{{$peminjaman_id}}">
                        <input type="hidden" name="peminjaman_detail_id" value="{{$peminjaman_detail_id}}">
                    </form>
                </a>
                <span class="mb-1">{{$barang->category}}</span>
                <span class="mr-auto d-block mb-3 badge badge-{{ 
                $barang->stock < 1 && $barang->type == 'pinjam' ? 'danger' : 'success' }}">{{ $barang->stock < 1 ? 'Stok Habis'  : "$barang->stock stok lagi"  }}
                </span>
            </div>  --}}

            
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{asset('js/page/modules-sweetalert.js')}}"></script>
@endsection