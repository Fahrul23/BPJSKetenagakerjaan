@extends('layouts.master')

@section('title', 'Barang')

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
        <a href="{{ route('aktivitas.pinjam.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
        <h1 class="d-xl-none d-md-none">{{ $item->name }}</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{route('aktivitas.pinjam.index')}}">Peminjaman</a></div>
            <div class="breadcrumb-item">{{ $item->name }}</div>

        </div>
    </div>

    {{-- alert --}}
    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            Terjadi kesalahan pemilihan barang!
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
                <div class="grid-custom">
                    {{-- <div class="card-header">
                        <h4>Detail Barang</h4>
                    </div> --}}
                    <div class="grid-body">
                        @if ( !empty($item) )

                            @foreach($item->items->where('condition', 'bagus') as $items)
                                <a class="grid-card" href="{{ route('aktivitas.pinjam.detail', ['id' => $items->id]) }}">
                                    <img src="{{ Storage::url($items->image) }}"/>
                                    <h4 class="text-primary">{{ $items->name }}</h4>
                                    <p>{{ $items->unique_id }}</p>
                                    <p class="grid-badge">
                                        <span class="badge badge-{{ $items->status ? "primary" : "danger" }} mr-2">
                                            {{ $items->status ? "Tersedia" : "Tidak ada" }}
                                        </span>
                                    </p>
                                    {{-- <span class="text-center">{{ $items->status }}</span> --}}
                                </a>
                            @endforeach

                        @else
                            <div class="col-12">
                                <p class="text-center">Tidak ada data barang!</p>
                            </div>
                        @endif
                    </div>
                    {{-- <div class="grid-footer">
                    {{ 
                        $items->appends([
                            'name' => request()->get('name')
                            // 'category' => request()->get('category')
                        ])->links() 
                    }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

    <script src="{{asset('js/page/modules-sweetalert.js')}}"></script>
    
@endsection