@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<section class="section">
          <div class="section-header">
            <h1 style="display: inline-block !important;">Dashboard</h1>
          </div>
          
            
          <div class="row">
            @if( Auth::user()->role == 'user' )
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            @else
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            @endif
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-cubes"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Peminjaman</h4>
                  </div>
                  <div class="card-body">
                    {{$pinjam}}
                  </div>
                </div>
              </div>
            </div>

            @if( Auth::user()->role == 'user' )
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            @else
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            @endif
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-cubes"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pengambilan</h4>
                  </div>
                  <div class="card-body">
                    {{$ambil}}
                  </div>
                </div>
              </div>
            </div>
            
           @if( Auth::user()->role =='user' )
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            @else
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            @endif
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="fas fa-redo"></i>
                    </div>
                  <div class="card-wrap">
                   <div class="card-header">
                     <h4>Barang belum kembali</h4>
                   </div>
                   <div class="card-body">
                    {{$return}}
                   </div>
                  </div>
                </div>
            </div>

            @if(Auth::user()->role == 'admin')

            @if( Auth::user()->role =='user' )
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            @else
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            @endif
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                      <i class="fas fa-exclamation-circle"></i>
                    </div>
                  <div class="card-wrap">
                   <div class="card-header">
                     <h4>Stock Barang Habis</h4>
                   </div>
                   <div class="card-body">
                    {{$stock}}
                   </div>
                  </div>
                  <div class="card-footer text-right">
                    <a href="/" class="badge badge-primary"></a>
                        Lihat
                      <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
            </div>
            @endif
          </div>

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Peminjaman Terbaru</h4>
                  <div class="card-header-action">
                     <a href="{{ route('riwayat_peminjaman') }}" class="btn btn-primary" >View All</a>
                     
                  </div>
                </div>
               <div class="card-body">
          <div class="table-responsive mt-3">
            <table class="table table-striped table-1 text-center">
              <thead>
               <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Barang</th>
                <th>Kategori</th>
                <th>Dari Tanggal</th>
                <th>sampai Tanggal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($peminjaman_terbaru as $key => $m)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$m->name}}</td>
                <td>{{$m->item}}</td>
                <td>{{$m->category}}</td>
                <td>{{ !empty($m->date_start) ? $m->date_start->isoFormat('dddd, D MMMM Y') : '-' }}</td>
                <td>{{ !empty($m->date_end) ? $m->date_end->isoFormat('dddd, D MMMM Y') : '-' }}</td>
                <td><a href="/" class="btn btn-primary">Konfirmasi</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
              </div>
            </div>
             <div class="col-lg-4 col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Barang Terbaru</h4>
                  <div class="card-header-action">
                    <div class="">
                      <a href="{{ route('barang') }}" class="btn btn-primary" >View All</a>
                      
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                  <div class="summary">
                    <div class="summary-item">
                      <ul class="list-unstyled list-unstyled-border">
                         @foreach($new as $n)
                        <li class="media">
                          <a href="#">
                            <img class="mr-3 rounded" width="50" src="storage/item-image/{{$n->image}}" alt="barang">
                          </a>
                          <div class="media-body">
                           
                            <div class="media-title"><a href="#">{{$n->item}}</a></div>
                            <div class="text-muted text-small">barang <a href="#">{{$n->type}}</a> 
                          </div>
                        </li>
                        @endforeach 
                      </ul>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection

@section('script')

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index.js') }}"></script>
<script src="{{asset('js/page/modules-datatables.js')}}"></script>

@endsection