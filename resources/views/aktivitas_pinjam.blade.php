@extends('layouts.master')

@section('title')
    Aktivitas Peminjaman
@endsection

@section('content')
<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
        <a href="{{ route('aktivitas.pinjam.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class="d-xl-none d-md-none">Barang</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item">Peminjaman</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">

            <div class="col-md-12">
                <form action="{{route ('aktivitas.pinjam.index')}}" method="get">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-custom btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collapse" id="mycard-collapse">
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
                                <button class="btn" type="reset">Reset</button>
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                {{-- <div class="card-header">
                    <h4>Detail Katalog</h4>
                </div> --}}
                <div class="grid-custom">
                    <div class="grid-body">
                        
                        @forelse ($items as $item)
                            <a class="grid-card" href="{{ route('aktivitas.pinjam.show', ['id' => $item->id]) }}">
                                <img src="{{ Storage::url($item->image) }}"/>
                                <h4 class="text-primar">{{ $item->name }}</h4>
                                <p>{{ $item->category->category }}</p>
                                <p class="grid-badge">
                                    <span class="badge badge-primary mr-2">
                                        {{ $item->items->count() }}
                                    </span> Unit
                                </p>
                                {{-- <span class="text-center">{{ $item->status }}</span> --}}
                            </a>
                        @empty
                            <p class="empty-msg text-center">Tidak ada data barang!</p>
                        @endforelse
                        
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

    <script src="{{asset('js/page/modules-sweetalert.js')}}"></script>
    
@endsection