@extends('layouts.master')

@section('title', 'Cart Peminjaman')

@section('content')
<section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
    <h1 class=" d-xl-none d-md-none">Cart Peminjaman</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
      <div class="breadcrumb-item">Cart Peminjaman</div>
    </div>
  </div>

  {{-- alert --}}
  @if ( $errors->any() )
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      Gagal menghapus data barang!
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
    <h2 class="section-title text-capitalize">peminjaman barang</h2>
    <p class="section-lead">Pemrosesan peminjaman barang untuk user.</p>
      @if ( !empty( $data ) )
        @foreach ( $data as $d )
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              @if ( Auth::user()->role != "user" )
                <div class="card-header">
                  <h4>{{ $d->user_name }}</h4>
                </div>
              @endif
              <div class="card-body">
                <div class="elemet-carousel owl-carousel owl-theme">

                  @foreach ( $d->items as $item )
                  <div>
                    <div class="product-item pb-3">
                      <div class="product-image">
                        <img alt="image" src="{{ Storage::url($item->image) }}" class="img-fluid">
                      </div>
                      <div class="product-details">
                        <div class="product-name">{{ $item->name }}</div>
                        <div class="text-muted text-small">
                          <p>
                            <div class="badge badge-primary mr-2">Qty</div> 
                            {{ $item->quantity }}
                          </p>
                          Tanggal Pinjam
                          <p>
                            <div class="badge badge-primary mr-2">Dari</div> {{ $item->date_start->isoFormat('DD MMMM YYYY') }}
                          </p>
                          <p>
                            <div class="badge badge-primary mr-2">Sampai</div> {{ $item->date_end->isoFormat('DD MMMM YYYY') }}
                          </p>
                        </div>
                        <div class="product-cta">
                          <span class="btn btn-danger" onclick="$(this).find('form').submit()">
                            Hapus
                            <form action="{{ route('cart_pinjam_remove') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="user" value="{{ $d->user_id }}">
                              <input type="hidden" name="item" value="{{ $item->id }}">
                            </form>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>
              </div>
              <div class="card-footer text-right">
                <span class="btn btn-danger" onclick="$(this).find('form').submit()">
                  Batal
                  <form action="{{ route('cart_pinjam_destroy', ['id' => $d->user_id]) }}" method="post">
                    @csrf
                    @method('delete')
                  </form>
                </span>
                <span class="btn btn-primary" onclick="$(this).find('form').submit()">
                  Proses
                  <form action="{{ route('cart_pinjam_store') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="user" value="{{ $d->user_id }}">
                  </form>
                </span>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      @else
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <p class="text-center mb-0">Tidak ada data pesanan!</p>
              </div>
            </div>
          </div>
        </div>
      @endif
  </div>
{{-- 
  <div class="section-body">
    <h2 class="section-title text-capitalize">peminjaman barang</h2>
    <p class="section-lead">Pemrosesan peminjaman barang untuk user.</p>
      @if ( !empty( $session ) )
        @foreach ( $session as $u )
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              @if ( Auth::user()->role != "user" )
                <div class="card-header">
                  <h4>{{ $user::find($u)->name }}</h4>
                </div>
              @endif
              <div class="card-body">
                <div class="elemet-carousel owl-carousel owl-theme">

                  @foreach ( Cart::session("pinjam_$u")->getContent() as $item )
                  <div>
                    <div class="product-item pb-3">
                      <div class="product-image">
                        <img alt="image" src="/storage/item-image/{{ $item->attributes['image'] }}" class="img-fluid">
                      </div>
                      <div class="product-details">
                        <div class="product-name">{{ $item->name }}</div>
                        <div class="text-muted text-small">
                          @if ( Route::currentRouteName() == 'cart_ambil' )
                            <p><div class="badge badge-primary mr-2">Qty</div> {{ $item->quantity }}</p>
                          @elseif( Route::currentRouteName() == 'cart_pinjam' )
                            Tanggal Pinjam
                            <p><div class="badge badge-primary mr-2">Dari</div> {{ $item->attributes['date_start'] }}</p>
                            <p><div class="badge badge-primary mr-2">Sampai</div> {{ $item->attributes['date_end'] }}</p>
                          @endif
                        </div>
                        <div class="product-cta">
                          <span class="btn btn-danger" onclick="$(this).find('form').submit()">
                            Hapus
                            <form action="{{ route('cart_remove') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="user" value="{{ $u }}">
                              <input type="hidden" name="item" value="{{ $item->id }}">
                              <input type="hidden" name="type" value="{{ 'pinjam' }}">
                            </form>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>
              </div>
              <div class="card-footer text-right">
                <span class="btn btn-danger" onclick="$(this).find('form').submit()">
                  Batal
                  <form action="{{ route('cart_cancel') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="user" value="{{ $u }}">
                    <input type="hidden" name="type" value="{{ 'pinjam' }}">
                  </form>
                </span>
                <span class="btn btn-primary" onclick="$(this).find('form').submit()">
                  Proses
                  <form action="{{ route('cart_store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user" value="{{ $u }}">
                    <input type="hidden" name="type" value="{{ 'pinjam' }}">
                  </form>
                </span>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      @else
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <p class="text-center mb-0">Tidak ada data pesanan!</p>
              </div>
            </div>
          </div>
        </div>
      @endif 
  </div>
--}}

</section>
@endsection

@section('script')
  <script src="{{ asset('/js/carousel-custom.js') }}"></script>
@endsection