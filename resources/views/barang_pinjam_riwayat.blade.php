@extends('layouts.master')

@section('title', 'Riwayat Barang Aset')

@section('content')

    <section class="section">
        <div class="section-header">
            <div class="section-header-back d-md-none">
                <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1 class="d-xl-none d-md-none">Barang Aset</h1>
            <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
                <div class="breadcrumb-item active"><a href="{{ route('panel') }}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{route('barang.pinjam.index')}}"> Barang Aset</a>
            </div>
                {{-- <div class="breadcrumb-item">Pinjam</div> --}}
                <div class="breadcrumb-item">Riwayat</div>
            </div>
        </div>

        @component('components.subnav.barang_pinjam')
            @slot('active')
            riwayat
            @endslot
        @endcomponent

        @if ( $errors->any() )
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                Gagal menghapus data!
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
                <div class="card">
                  <div class="card-header">
                    <h4>Riwayat</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive mt-3">
                      <table class="table table-striped table-1 text-center">
                      <thead>
                        <tr>
                          <th>No</th>
                          {{-- <th>No. Barang</th> --}}
                          <th>Nama Barang</th>
                          <th>Gambar Barang</th>
                          <th>Kategori</th>
                          {{-- <th>Kondisi Barang</th> --}}
                          <th>Dihapus tanggal</th>
                          <th class="text-center">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($item as $key => $m)
                        <tr>
                          <td>{{$key+1}}</td>
                          {{-- <td>{{$m->unique_id}}</td> --}}
                          <td>{{$m->name}}</td>
                          <td><img width="100" class="img-thumbnail" src="storage/item-image/{{$m->image}}" /></td>
                          <td>{{ empty($m->category_id) ? '-' : $m->category->category }}</td>
                          {{-- <td>
                            @php
                              switch($m->condition) {
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
                            <span class="{{ $badge }}">{{($m->condition) ? $m->condition : '-'}}</span>
                          </td> --}}
                          <td>{{ $m->deleted_at->isoFormat('dddd, D MMMM Y') }} </td>
                          <td class="flex-button">
                            <a href="{{route('barang.pinjam.kembali', ['id' => $m->id])  }}" class="btn btn-success" data-placement="top" title="Kembalikan Data Barang">
                              <i class="fas fa-undo"></i></a> 
                            <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'), true)" data-toggle="tooltip" data-placement="top" title="Hapus">
                              <i class="far fa-trash-alt"></i>
                              <form action="{{route('barang.pinjam.destroy')}}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $m->id }}">
                              </form>
                            </a>
                          </td>
                        </tr>
                        @empty

                          <tr>
                            <td colspan="7">
                              <div class="empty-state" data-height="400" style="min-height: 400px;">
                                <div class="empty-state-icon">
                                  <i class="fas fa-question"></i>
                                </div>
                                <h2>Tidak ada riwayat hapus dari barang aset!</h2>
                              </div>
                            </td>
                          </tr>

                        @endforelse

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

               
            </div>
        </div>

    </section>

@endsection


@section('script')

<script>

    $(document).ready(function() {
        horiscroll($('.scroller'));
    })

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

<script>
    
</script>

@endsection


