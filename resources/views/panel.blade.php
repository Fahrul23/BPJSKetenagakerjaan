@extends('layouts.master')

@section('title', 'Panel')

@section('content')

<section class="section">

    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">
                                @if (Auth::user()->role == 'user')
                                    Aktivitas
                                @else
                                    Jenis Barang
                                @endif
                            </div>
                            <div class="row card-stats-items">
                                <div class="col-6 text-center card-stats-item">
                                    <div class="card-stats-item-count">
                                        {{ Auth::user()->role == "admin" ? $item_pinjam_jum : $act_pinjam_jum }}
                                    </div>
                                    <div class="card-stats-item-label">
                                        {{ Auth::user()->role == "admin" ? "Barang Aset" : "Peminjaman" }}
                                    </div>
                                </div>
                                <div class="col-6 text-center card-stats-item">
                                    <div class="card-stats-item-count">
                                        {{ Auth::user()->role == "admin" ? $item_ambil_jum : $act_ambil_jum }}
                                    </div>
                                    <div class="card-stats-item-label">
                                        {{ Auth::user()->role == "admin" ? "Barang Consumable" : "Pengambilan" }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            
                            <div class="card-header">
                                <h4>{{ Auth::user()->role == 'admin' ? 'Total Barang' : 'Total Aktivitas' }}</h4>
                            </div>
                            <div class="card-body">
                                {{ Auth::user()->role == "admin" ? $item_jum : $act_jum }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12">
                    <a href="{{route('riwayat.kembali.index')}}">
                        <div class="card card-dashboard-stats-item card-statistic-2">
                            <div class="card-icon shadow-danger bg-danger">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Barang Aset Belum Kembali</h4>
                                </div>
                                <div class="card-body">
                                    {{ $item_kembali_jum }}
                                </div>
                            </div>
                            <div class="card-action">Selengkapnya<i class="fas fa-chevron-right"></i></div>
                        </div>
                    </a>
                </div>

                @if ( Auth::user()->role == 'admin' )
                    <div class="col-sm-6 col-md-12">
                        <a href="{{route('barang.ambil.habis')}}">
                            <div class="card card-dashboard-stats-item card-statistic-2">
                                <div class="card-icon shadow-danger bg-danger">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Stok Barang Consumable Habis</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $item_habis_jum }}
                                    </div>
                                </div>
                                <div class="card-action">Selengkapnya <i class="fas fa-chevron-right"></i></div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-dashboard-new-item">
                <div class="card-header">
                    <h4>Update Stok Barang Consumable</h4>
                    {{-- <div class="card-header-action dropdown">
                        <a href="{{route('barang.ambil.index')}}" class="btn btn-primary">Selengkapnya</a>
                    </div> --}}
                </div>
                <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none;">
                    <ul class="list-unstyled list-unstyled-border">
                        @foreach ($item_baru as $item)
                        <li class="media">
                                <img class="mr-3 rounded" width="55" src="{{ Storage::url($item->image) }}" alt="product">
                                <div class="media-body">
                                <div class="media-title">{{ $item->name }}</div>
                                <div class="mt-1">
                                    <div class="budget-price">
                                        <div>Stock</div>
                                        {{-- <div class="budget-price-square bg-primary" data-width="64%" style="width: 64%;"></div> --}}
                                        <div class="budget-price-label badge badge-success">{{ $item->stock }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="media-footer">
                                <a href="{{ route('barang.ambil.detail', ['id' => $item->id]) }}" class="font-weight-600 text-small btn btn-primary">Lihat</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="card-footer pt-3 d-flex justify-content-center">
                    <div class="d-flex flex-column budget-price justify-content-center">
                        <div class="budget-price-label mb-2">Total Barang</div>
                    <h4>{{ $item_baru_jum }}</h4>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index.js') }}"></script>

@endsection