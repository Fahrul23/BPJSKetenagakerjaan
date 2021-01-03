@extends('layouts.master')

@section('title', 'Laporan Peminjaman')

@section('content')

<section class="section">

  <div class="section-header">
     <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
    <h1 class=" d-xl-none d-md-none">Laporan Peminjaman</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></div>
      <div class="breadcrumb-item">Laporan Peminjaman</div>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <form action="{{route('laporan_peminjaman')}}" method="GET">
          <div class="card">
            <div class="card-header">
              <h4>Filter Data</h4>
              <div class="card-header-action">
                <a data-collapse="#mycard-collapse" class="btn btn-custom btn-icon btn-primary" href="#"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <div class="collapse" id="mycard-collapse" style="">
              <div class="card-body">
                
                <div class="row">

                    @can('admin')
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label class="d-block">Nama</label>
                                <select class="form-control" name="user">
                                    <option value="">Semua</option>
                                    @foreach( $users as $user )
                                        <option {{ request()->get('user') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endcan

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Dari tanggal</label>
                            <input type="date" name="start" class="form-control" value="{{ request()->get('start') }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Sampai tanggal</label>
                            <input type="date" name="end" class="form-control" value="{{ request()->get('end') }}">
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
            <h4>Data Peminjaman</h4>
            <div class="card-header-action">
              <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle notification-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Export
                </button>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: -30px; will-change: transform;">
                  <a class="dropdown-item has-icon" href="#" onclick="$(this).find('form').submit()"><i class="fas fa-file-excel" style="color: #47c363;"></i> Export Excel
                    <form action="{{route('laporan_peminjaman_export_excel')}}" method="POST">
                      @csrf
                      <input type="hidden" name="user_name" value="{{request()->get('user')}}">
                      <input type="hidden" name="start" class="form-control" value="{{ request()->get('start') }}">
                      <input type="hidden" name="end" class="form-control" value="{{ request()->get('end') }}">
                    </form>
                  </a>
                  <a class="dropdown-item has-icon" href="#" onclick="$(this).find('form').submit()"><i class="fas fa-file-pdf" style="color: #fc544b;"></i> Export PDF
                    <form action="{{route('laporan_peminjaman_export_pdf')}}" method="POST">
                      @csrf
                      <input type="hidden" name="user_name" value="{{request()->get('user')}}">
                      <input type="hidden" name="start" class="form-control" value="{{ request()->get('start') }}">
                      <input type="hidden" name="end" class="form-control" value="{{ request()->get('end') }}">
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
                    <th>No. Peminjaman</th>
                    <th>Nama</th>
                    <th>Tanggal Pengajuan</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($peminjamans as $key => $peminjaman)
                  <tr>
                    <td>{{$peminjaman->id}}</td>
                    <td>{{$peminjaman->user->name}}</td>
                    <td>{{$peminjaman->created_at->isoFormat('dddd, D MMMM Y')}}</td>
                    <td>
                      <a href="{{route('laporan_peminjaman_detail', ['id' => $peminjaman->id])}}" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  @empty
                    <tr>
                      <td colspan="7">
                        <div class="empty-state" data-height="400" style="min-height: 400px;">
                          <div class="empty-state-icon">
                            <i class="fas fa-question"></i>
                          </div>
                          <h2>Maaf, data yang anda cari tidak ada!</h2>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          @if ( $peminjamans->hasPages() )
            <div class="card-footer">
                {{ 
                    $peminjamans->appends([
                        'user' => request()->get('user'),
                        'start' => request()->get('start'),
                        'end' => request()->get('end')
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
