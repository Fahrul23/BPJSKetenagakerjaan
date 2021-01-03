@extends('layouts.master')

@section('title')
    Aktivitas Pengambilan
@endsection

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
        <a href="{{ route('aktivitas.ambil.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class="d-xl-none d-md-none">Barang</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex text-capitalize">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">home</a></div>
            <div class="breadcrumb-item">pengambilan</div>
        </div>
    </div>

    {{-- alert --}}
    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            Gagal memesan barang!
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
                <form action="{{route ('aktivitas.ambil.index')}}" method="get">
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
                                            @foreach($categories as $category)
                                                <option {{ request()->get('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{$category->category}}</option>
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
                            <a class="grid-card" href="{{ route('aktivitas.ambil.show', ['id' => $item->id]) }}">
                                <img src="{{ Storage::url($item->image) }}"/>
                                <h4 class="text-primar">{{ $item->name }}</h4>
                                <p>{{ $item->category->category }}</p>
                                <p class="grid-badge text-capitalize">
                                    @if ( $item->stock > 0 )
                                        <span class="badge badge-primary mr-2">{{ $item->stock }}</span> {{ $item->unit }}
                                    @else
                                        <span class="badge badge-danger">stock habis</span>
                                    @endif
                                </p>
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