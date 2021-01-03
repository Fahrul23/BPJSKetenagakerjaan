@extends('layouts.master')

@section('title', 'Laporan Barang')

@section('content') 

<section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
    <h1 class=" d-xl-none d-md-none">Laporan Barang</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></div>
      <div class="breadcrumb-item">Laporan Barang</div>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <form action="{{route('laporan_barang')}}" method="GET">
          <div class="card">
            <div class="card-header">
              <h4>Filter Data</h4>
              <div class="card-header-action">
                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus" ></i></a>
              </div>
            </div>
            <div class="collapse" id="mycard-collapse" style="">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-3 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0">
                    <div class="form-group">
                      <label class="d-block">Tipe Barang</label>
                      <select class="form-control" name="type">
                        <option value=""> -- Semua Tipe Barang -- </option>
                        <option value="ambil" {{ request()->get('type') == 'ambil' ? 'selected' : '' }}>Ambil</option>
                        <option value="pinjam" {{ request()->get('type') == 'pinjam' ? 'selected' : '' }}>Pinjam</option>

                      </select>
                    </div>
                  </div>

                  <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-3 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0">
                    <div class="form-group">
                      <label class="d-block">Kondisi Barang</label>
                      <select class="form-control" name="kondisi_barang">
                        <option value=""> -- Semua Kondisi Barang -- </option>
                        <option value="bagus" {{ request()->get('kondisi_barang') == 'bagus' ? 'selected' : '' }}>Bagus</option>
                        <option value="rusak" {{ request()->get('kondisi_barang') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="hilang" {{ request()->get('kondisi_barang') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-3 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0">
                    <div class="form-group">
                      <label class="d-block">Kategori</label>
                      <select class="form-control" name="category">
                        <option value=""> -- Semua Kategori -- </option>
                        @foreach($category as $kategori)
                        <option {{ request()->get('category') == $kategori->id ? 'selected' : '' }} value="{{ $kategori->id }}">{{$kategori->category}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-3 mt-3 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0">
                    <div class="form-group">
                      <label class="d-block">Tanggal</label>
                      <input type="text" class="daterange-btn form-control" value="" placeholder="-- Pilih Tanggal --">
                      <input type="hidden" class="waktu" value="" name="date">
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
      </div>
    </div>
  </div>

   <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Barang</h4>
            <div class="card-header-action">
              <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle notification-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Export
                </button>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: -30px; will-change: transform;">
                  <a class="dropdown-item has-icon" href="#" onclick="$(this).find('form').submit()"><i class="fas fa-file-excel" style="color: #47c363;"></i> Export Excel
                <form action="{{route('laporan_barang_export_excel')}}" method="POST">
                  @csrf
                  <input type="hidden" name="category_id" value="{{request()->get('category')}}">
                  <input type="hidden" name="type" value="{{request()->get('type')}}">
                  <input type="hidden" name="time" value="{{ request()->get('date') }}">
                  <input type="hidden" name="item_condition" value="{{ request()->get('kondisi_barang') }}">
                </form>
                  </a>
                  <a class="dropdown-item has-icon" href="#" onclick="$(this).find('form').submit()"><i class="fas fa-file-pdf" style="color: #fc544b;"></i> Export PDF
                <form action="{{route('laporan_barang_export_pdf')}}" method="POST">
                  @csrf
                  <input type="hidden" name="category_id" value="{{request()->get('category')}}">
                  <input type="hidden" name="type" value="{{request()->get('type')}}">
                  <input type="hidden" name="time" value="{{ request()->get('date') }}">
                  <input type="hidden" name="item_condition" value="{{ request()->get('kondisi_barang') }}">
                </form>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive mt-3">
              <table class="table table-striped table-1 text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Barang</th>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Tipe Barang</th>
                    <th>Stock</th>
                    <th>Kondisi Barang</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($item as $key => $i)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$i->unique_id}}</td>
                    <td>
                      <img width="100" class="img-thumbnail" src="/storage/item-image/{{$i->image}}"/>
                    </td>
                    <td>{{$i->item}}</td>
                    <td>{{$i->category}}</td>
                    <td><span class="badge badge-{{ $i->type == 'ambil' ? 'info' : 'success' }} text-capitalize">{{$i->type}}</span></td>
                    <td>{{$i->type == 'ambil' ? $i->stock : '-' }}</td>
                    <td>
                      @php
                        switch($i->kondisi_barang) {
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
                      <span class="{{ $badge }} text-capitalize">{{($i->kondisi_barang) ? $i->kondisi_barang : '-'}}</span>
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
</section>

@endsection

@section('script')

<script src="{{asset('js/page/modules-datatables.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@endsection