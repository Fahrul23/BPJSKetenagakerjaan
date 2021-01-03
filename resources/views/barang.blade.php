  @extends('layouts.master')

  @section('title', 'Data Barang')

  @section('content') 

  <section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
    <h1 class="d-xl-none d-md-none">Data Barang</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
      <div class="breadcrumb-item">Data Barang</div>
    </div>
  </div>
  
  {{-- alert --}}
  @if ( $errors->any() )
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      Gagal menambahkan data barang!
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
      <div class="col-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-th-list"></i> Data Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-plus"></i> Tambah Data</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="far fa-trash-alt"></i> Recycle Bin</a>
          </li>
          
          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Barang sudah habis!</h4>
                    <div class="card-header-action">
                      <span class="badge badge-danger">{{ $barang->count() }} barang</span>
                      <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                    </div>
                  </div>
                  <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-1 text-center">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>No. Barang</th>
                              <th>Nama Barang</th>
                              <th>Gambar Barang</th>
                              <th>Kategori</th>
                              <th>Tipe Barang</th>
                              <th>Stok</th>
                              <th>Kondisi Barang</th>
                              <th>Tanggal Buat</th>
                              <th>Opsi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($barang as $key => $m)
                            <tr>
                              <td>{{$key + 1}}</td>
                              <td>{{$m->unique_id}}</td>
                              <td>{{$m->item}}</td>
                              <td><img width="100" class="img-thumbnail" src="/storage/item-image/{{$m->image}}"/></td>
                              <td>{{ empty($m->category_id) ? '-' : $m->GetCategory->category }}</td>
                              <td>
                                <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }} text-capitalize">{{$m->type}}</span>
                              </td>
                              <td>{{ $m->type == 'ambil' ? $m->stock : '-' }}</td>
                              <td>
                                @php
                                switch($m->kondisi_barang) {
                                  case 'bagus':
                                      $badge = 'badge badge-success';
                                      break;
                                  case 'rusak':
                                      $badge = 'badge badge-info';
                                      break;
                                  case 'hilang':
                                      $badge = 'badge badge-info';
                                      break;
                                  default:
                                      $badge = '';
                                      break;
                                }
                                @endphp
                                <span class="{{ $badge }}">{{($m->kondisi_barang) ? $m->kondisi_barang : '-'}}</span>
                              </td>
                              <td>{{ $m->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                              <td>
                                <a href="{{route('edit_barang', ['id' => $m->id])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Tambah Stok Barang">
                                <i class="fas fa-plus"></i></a> 
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
  
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Barang</h4>
                    <div class="card-header-action">
                      <span class="badge badge-primary">{{ $item->count() }} barang</span>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive mt-3">
                      <table class="table table-striped table-1 text-center">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>No. Barang</th>
                            <th>Nama Barang</th>
                            <th>Gambar Barang</th>
                            <th>Kategori</th>
                            <th>Tipe Barang</th>
                            <th>Stok</th>
                            <th>Kondisi Barang</th>
                            <th>Tanggal Buat</th>
                            <th>Opsi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($item as $key => $m)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$m->unique_id}}</td>
                            <td>{{$m->item}}</td>
                            <td><img width="100" class="img-thumbnail" src="storage/item-image/{{$m->image}}"/></td>
                            <td>{{ empty($m->category_id) ? '-' : $m->GetCategory->category }}</td>
                            <td>
                              <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }} text-capitalize">{{$m->type}}</span>
                            </td>
                            <td>{{ $m->stock }}</td>
                            <td>
                              @php
                                switch($m->kondisi_barang) {
                                case 'bagus':
                                  $badge = 'badge badge-success';
                                  break;
                                case 'rusak':
                                  $badge = 'badge badge-warning';
                                  break;
                                case 'hilang':
                                  $badge = 'badge badge-danger';
                                  break;
                                default:
                                  $badge = '';
                                  break;
                              }
                              @endphp
                                <span class="{{ $badge }} text-capitalize">{{($m->kondisi_barang) ? $m->kondisi_barang : '-'}}</span>
                              </td>
                            <td>{{ $m->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                            <td class="d-flex">
                              <a href="{{route('edit_barang', ['id' => $m->id])}}" class="btn btn-success mr-1" data-toggle="tooltip" data-placement="top" title="Ubah Data Barang"><i class="far fa-edit"></i></a> 
                              <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'))" data-toggle="tooltip" data-placement="top" title="Hapus Data Barang">
                                <i class="far fa-trash-alt"></i>
                                <form action="{{route('hapus_barang')}}" method="POST">
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
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              <div class="col-12">
                <div class="card mt-3">

                  {{-- form tambah --}}

                  <form action="{{ route('barang') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="card-header">
                      <h4>Form Tambah Data</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label class="form-label">Pilih jenis barang</label>
                            <div class="selectgroup w-100">
                              @foreach (['ambil', 'pinjam'] as $type)
                              <label class="selectgroup-item" data-type="{{ $type }}">
                                <input type="radio" name="type" value="{{ $type }}" class="selectgroup-input" @if($type == 'ambil' || old('type') == "pinjam") checked @endif>
                                <span class="selectgroup-button text-capitalize">{{ $type }}</span>
                              </label>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label>Nama Barang</label>

                            <input type="text" name="item" value="{{old ('item')}}" class="form-control @error('item') is-invalid @enderror">
                            @error('item')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror     

                          </div>
                          <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{old ('stock')}}">
                            @error('stock')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror     
                          </div>
                          <div class="form-group">
                            <label>Kategori</label>

                            <select class="form-control text-capitalize @error('category') is-invalid @enderror" name="category">
                              <option value="">Pilih kategori</option>
                              @foreach ($category as $item)
                              <option value="{{ $item->id }}" @if (old('category') == $item->category) {{ 'selected' }} @endif class="text-capitalize">{{ $item->category }}</option>
                              @endforeach
                            </select>
                            @error('category')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror   

                          </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                          <div class="form-group mb-0">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control dropzone @error('image') is-invalid @enderror">
                            @error('image')
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
                          <th>No. Barang</th>
                          <th>Nama Barang</th>
                          <th>Gambar Barang</th>
                          <th>Kategori</th>
                          <th>Tipe Barang</th>
                          <th>Stok</th>
                          <th>Kondisi Barang</th>
                          <th>Dihapus tanggal</th>
                          <th class="text-center">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($item_trashed as $key => $m)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$m->unique_id}}</td>
                          <td>{{$m->item}}</td>
                          <td><img width="100" class="img-thumbnail" src="storage/item-image/{{$m->image}}" /></td>
                          <td>{{ empty($m->category_id) ? '-' : $m->GetCategory->category }}</td>
                          <td>
                            <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }}">{{$m->type}}</span>
                          </td>
                          <td>{{$m->stock}}</td>
                          <td>
                            @php
                              switch($m->kondisi_barang) {
                              case 'bagus':
                                $badge = 'badge badge-success';
                                break;
                              case 'rusak':
                                $badge = 'badge badge-warning';
                                break;
                              case 'hilang':
                                $badge = 'badge badge-danger';
                                break;
                              default:
                                $badge = '';
                                break;
                            }
                            @endphp
                            <span class="{{ $badge }}">{{($m->kondisi_barang) ? $m->kondisi_barang : '-'}}</span>
                          </td>
                          <td>{{ $m->deleted_at->isoFormat('dddd, D MMMM Y') }} </td>
                          <td class="flex-button">
                            <a href="{{route('kembali_barang', ['id' => $m->id])  }}" class="btn btn-success" data-placement="top" title="Kembalikan Data Barang">
                              <i class="fas fa-undo"></i></a> 
                            <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'), true)" data-toggle="tooltip" data-placement="top" title="Hapus">
                              <i class="far fa-trash-alt"></i>
                              <form action="{{route('buang_barang')}}" method="POST">
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
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('script')

<script src="{{asset('js/page/modules-datatables.js')}}"></script>
<script>
  // $('.selectgroup-input').each(function(i, e) {
  //   if ( $(e).is(':checked') ) {
  //     if ( $(e).val() === 'pinjam' ) $('input[name="stock"]').parent().hide()
  //   }
  // })
  // $('.selectgroup-item').click(function(e) {
  //   const stock = $('input[name="stock"]').parent();
  //   $(this).attr('data-type') === 'pinjam' ? stock.hide() : stock.show();
  // })
  function alertDelete(e, type = false) {
    let setup = {
      title: 'Kamu yakin mau hapus barang ini?',
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