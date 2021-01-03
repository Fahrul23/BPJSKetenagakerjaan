@extends('layouts.master')

@section('title', 'Tambah Kategori Barang')

@section('content') 

<section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
    <h1 class=" d-xl-none d-md-none">Tambah Kategori Barang</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></div>
      <div class="breadcrumb-item active"><a href="{{url('kategori')}}">Kategori Barang</a></div>
      <div class="breadcrumb-item">Tambah Kategori</div>
    </div>
  </div>

  @component('components.subnav.kategori')
    @slot('active')
      tambah
    @endslot
  @endcomponent

  {{-- alert --}}
  @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        Gagal menambahkan data kategori!
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
            <div class="card mt-3">
                <form action="{{ route('input_kategori') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4> Form Tambah Data</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" name="category" value="{{old ('category')}}" class="form-control @error('category') is-invalid @enderror">
                                @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</section>

@endsection

@section('script')

  <script src="{{asset('js/page/modules-datatables.js')}}"></script>
  <script>
    $('.selectgroup-input').each(function(i, e) {
      if ( $(e).is(':checked') ) {
        if ( $(e).val() === 'pinjam' ) $('input[name="stock"]').parent().hide()
      }
    })
    $('.selectgroup-item').click(function(e) {
      const stock = $('input[name="stock"]').parent();
      $(this).attr('data-type') === 'pinjam' ? stock.hide() : stock.show();
    })
    function alertDelete(e, type = false) {
      let setup = {
        title: 'Kamu yakin menghapus data?',
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
        console.log(result)
        if (result.value) {
          e.submit();
        }
      });
    }
  </script>

@endsection