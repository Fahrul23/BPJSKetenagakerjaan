@extends('layouts.master')

@section('title', 'Kategori Barang')

@section('content') 

<section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
    <h1 class=" d-xl-none d-md-none">Kategori Barang</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></div>
      <div class="breadcrumb-item">Kategori Barang</div>
    </div>
  </div>

  @component('components.subnav.kategori')
    @slot('active')
      data
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

      {{-- <div class="col-12 d-none d-sm-block"> --}}
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Kategori Barang</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive mt-3">
              <table class="table table-striped table-1 text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Tanggal Buat</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($category as $i => $m)
                  <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$m->category}}</td>
                    <td>{{Carbon\Carbon::parse($m->created_at)->translatedFormat('l, d F Y')}}</td>
                    <td>
                      <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'))" data-toggle="tooltip" data-placement="top" title="Hapus Kategori">
                        <i class="far fa-trash-alt"></i>
                        <form action="{{ route('hapus_kategori') }}" method="POST">
                          @csrf
                          @method('delete')
                          <input type="hidden" name="id" value="{{ $m->id }}">
                        </form>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- <div class="col-md-12 d-block d-sm-none">
        <div class="grid-custom">
          <div class="grid-body">
            @if ( $category->count() > 0 )
              @foreach($category as $i => $m)
                <div class="grid-card">
                  {{-- <img src="{{ Storage::url($item->image) }}" alt=""> --}}
                  {{-- <h4>{{ $m->category }}</h4>
                  
                    <a href="#" class="btn btn-danger mt-3" onclick="alertDelete($(this).find('form'))">
                      <i class="far fa-trash-alt"></i> Hapus
                      <form action="{{ route('hapus_kategori') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $m->id }}">
                      </form>
                    </a> --}} 
                  
                  {{-- <p class="grid-badge"><span class="badge badge-primary mr-2">{{ $m->item->count()}}</span> Barang</p> --}}
                {{-- </div>
              @endforeach
            @else
                <p class="text-center">Tidak ada data barang!</p>
            @endif
          </div> --}}
          {{-- @if( $category->hasPages() )
            <div class="grid-footer">
              {{ $category->links() }}
              </div>
          @endif --}}
        {{-- </div>
      </div> --}}
        
        {{-- <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Kategori Barang</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive mt-3">
                      <table class="table table-striped table-1 text-center">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Tanggal Buat</th>
                            <th>Opsi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($category as $i => $m)
                          <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$m->category}}</td>
                            <td>{{Carbon\Carbon::parse($m->created_at)->translatedFormat('l, d F Y')}}</td>
                            <td>
                              <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'))" data-toggle="tooltip" data-placement="top" title="Hapus Kategori">
                                <i class="far fa-trash-alt"></i>
                                <form action="{{ route('hapus_kategori') }}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <input type="hidden" name="id" value="{{ $m->id }}">
                                </form>
                              </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div> --}}

        {{-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
          
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Recycle Bin</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive mt-3">
                      <table class="table table-striped table-1 text-center">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Kategori</th>
                          <th>Tanggal Hapus</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($category_trashed as $i => $m)
                        <tr>
                          <td>{{$i+1}}</td>
                          <td>{{$m->category}}</td>
                          <td>{{Carbon\Carbon::parse($m->deleted_at)->translatedFormat('l, d F Y')}}</td>
                          <td>
                            <a href="{{ route('kembali_kategori', ['id' => $m->id]) }}" class="btn btn-success" data-placement="top" title="Kembalikan Data Barang">
                              <i class="fas fa-undo"></i></a> 
                            <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'), true)" data-toggle="tooltip" data-placement="top" title="Hapus">
                              <i class="far fa-trash-alt"></i>
                              <form action="{{url('buang_kategori')}}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $m->id }}">
                              </form>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
    
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