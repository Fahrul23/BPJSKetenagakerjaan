@extends('layouts.master')

@section('title') 
{{$item_pinjam->name}}
@endsection

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
        <a href="{{route('konfirmasi_peminjaman_ganti', ['id' => $peminjaman_detail_id])}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class="d-xl-none d-md-none">{{$item_pinjam->name}}</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman')}}">Konfirmasi Peminjaman</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman_detail', ['id' => $peminjaman_id])}}">Konfirmasi Peminjaman Detail</a></div>
            <div class="breadcrumb-item active"><a href="{{route('konfirmasi_peminjaman_ganti', ['id' => $peminjaman_detail_id])}}">Ubah Barang</a></div>
            <div class="breadcrumb-item">{{$item_pinjam->name}}</div>

        </div>
    </div>

    <div class="section-body">
        <div class="row">
            {{-- <div class="col-12">
                <form action="{{ route('item_pinjam', ['id' => $id]) }}">
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
                                    <div class="col-sm-12 col-md-6">
                                        <label for="">Nama Detail Barang</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="name" value="{{ request()->get('name') }}" placeholder="Cari Nama Detail Barang">
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

            </div> --}}
            <div class="col-12">
                {{-- <div class="card-header">
                    <h4>Detail Katalog</h4>
                </div> --}}
                <div class="grid-custom">
                    <div class="grid-body">
                        @if ( count($item) > 0 )

                            @foreach($item as $barang)
                                <a class="grid-card" style="cursor: pointer;" onclick="$(this).find('form').submit()" >
                                    <form action="{{ route('konfirmasi_peminjaman_ganti_detail', ['id' => $barang->id]) }}" method="post">
                                    @csrf
                                        <input type="hidden" name="peminjaman_id" value="{{$peminjaman_id}}">
                                        <input type="hidden" name="peminjaman_detail_id" value="{{$peminjaman_detail_id}}">
                                    </form>
                                    <img src="{{ Storage::url($barang->image) }}"/>
                                    <h4 class="text-primary">{{ $barang->name }}</h4>
                                    <p>{{ $barang->unique_id }}</p>
                                    <p class="grid-badge">
                                        <span class="badge badge-{{ $barang->status ? "primary" : "danger" }} mr-2">
                                            {{ $barang->status ? "Tersedia" : "Tidak ada" }}
                                        </span>
                                    </p>
                                    {{-- <span class="text-center">{{ $barang->status }}</span> --}}
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
                            'name' => request()->get('name')
                            // 'category' => request()->get('category')
                        ])->links() 
                    }}
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