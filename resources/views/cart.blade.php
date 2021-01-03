@extends('layouts.master')

@section('title', 'Cart')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Cart</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('panel')}}">Menu</a></div>
      <div class="breadcrumb-item">Cart</div>
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
    <h2 class="section-title text-capitalize">{{ $title }} Barang</h2>
    <p class="section-lead">Pemrosesan {{ $title }} barang untuk user.</p>

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

                  @foreach ( Cart::session( $title == 'peminjaman' ? "pinjam_$u" : "ambil_$u" )->getContent() as $item )
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
                              <input type="hidden" name="type" value="{{ $title == 'peminjaman' ? 'pinjam' : 'ambil' }}">
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
                    <input type="hidden" name="type" value="{{ $title == 'peminjaman' ? 'pinjam' : 'ambil' }}">
                  </form>
                </span>
                <span class="btn btn-primary" onclick="$(this).find('form').submit()">
                  Proses
                  <form action="{{ route('cart_store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user" value="{{ $u }}">
                    <input type="hidden" name="type" value="{{ $title == 'peminjaman' ? 'pinjam' : 'ambil' }}">
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
</section>
@endsection

@section('script')
  <script src="{{ asset('/js/carousel-custom.js') }}"></script>
@endsection