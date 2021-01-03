@extends('layouts.master')

@section('title', 'Aktivitas')

@section('modal')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">         
            <div class="modal-body">
                <div class="wizard-steps">
                    <div class="wizard-step wizard-step-active">
                        <div class="wizard-step-icon">
                            <i class="far fa-times-circle"></i>
                        </div>
                        <div class="wizard-step-label">
                            Input Alasan Tolak
                        </div>
                    </div>
                    <div class="wizard-step">
                        <div class="wizard-step-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div class="wizard-step-label">
                            Pilih Barang
                        </div>
                    </div>
                </div>
                <form>
                    <fieldset>
                        <div class="form-group">
                            <label>Alasan Tolak Peminjaman User</label>
                            <input type="text" class="form-control" name="alasan_tolak">
                        </div>
                        <button type="button" id="next" class="btn btn-icon icon-right btn-primary">Selanjutnya </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section class="section">

    <div class="section-header">
        <h1 class="text-capitalize">Konfirmasi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('panel')}}">Menu</a></div>
            <div class="breadcrumb-item">Konfirmasi</div>
        </div>
    </div>

    {{-- alert --}}
    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            Gagal mengkonfirmasi barang!
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
                        <h4>Konfirmasi pemesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Barang</th>
                                        <th>Gambar</th>
                                        <th>Tipe Barang</th>
                                        <th>Kategori</th>
                                        <th>Qty</th>
                                        <th>Alasan Pinjam</th>
                                        <th>Dari tanggal</th>
                                        <th>Sampai tanggal</th>
                                        <th colspan="3">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ( $activity->isEmpty() )
                                    <td colspan="9">
                                        <p>Tidak ada data pemesanan!</p>
                                    </td>
                                    @else
                                    @foreach($activity as $key => $m)
                                    <tr>
                                        <td>{{$m->name}}</td>
                                        <td>{{$m->item}}</td>
                                        <td><img width="100" class="img-thumbnail" src="/storage/item-image/{{$m->image}}" /></td>
                                        <td>
                                            <span class="badge badge-{{ $m->type == 'ambil' ? 'info' : 'success' }}">{{$m->type}}</span>
                                        </td>
                                        <td>{{$m->category}}</td>
                                        <td>{{$m->quantity}}</td>
                                        <td>{{$m->alasan_pinjam}}</td>
                                        <td>{{ !empty($m->date_start) ? $m->date_start->format('l, d F Y') : '-' }}</td>
                                        <td>{{ !empty($m->date_end) ? $m->date_end->format('l, d F Y') : '-' }}</td>
                                        <td>
                                            <span class="btn btn-primary" onclick="$(this).find('form').submit()">
                                                Konfirmasi
                                                <form action="" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $m->id }}">
                                                </form>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="btn btn-danger" onclick="$(this).find('form').submit()">
                                                Batal
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $m->id }}">
                                                </form>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Tolak</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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

<script>
    // $(document).ready(function() {
    //     let selected_fs, next_fs, prev_fs, opacity;


    //     $('#next').click(function() {

    //        selected_fs = $(this).parent();
    //        next_fs = $(this).parent().next();

    //        $('.wizard-steps .wizard-step').eq($('fieldset').index(next_fs)).addClass('wizard-step-active');

    //        next_fs.show();

    //        selected_fs.animate({opacity: 0}, {
    //         step: function(now) {
    //         // for making fielset appear animation
    //         opacity = 1 - now;
    //         selected_fs.css({
    //             'display': 'none',
    //             'position': 'relative'
    //         });
    //         next_fs.css({'opacity': opacity});
    //         }
          
    //     });
    // });

    //     $('#prev').click(function() {
    //         selected_fs = $(this).parent();
    //         prev_fs = $(this).parent().prev();

    //         $('.wizard-steps .wizard-step').eq($('fieldset').index(selected_fs)).removeClass('wizard-step-active');

    //         prev_fs.show();

    //         selected_fs.animate({opacity: 0}, {
    //         step: function(now) {
    //         // for making fielset appear animation
    //         opacity = 1 - now;
    //         selected_fs.css({
    //             'display': 'none',
    //             'position': 'relative'
    //         });
    //         prev_fs.css({'opacity': opacity});
    //         }
          
    //     });
    //     })
    // });

</script>

@endsection
