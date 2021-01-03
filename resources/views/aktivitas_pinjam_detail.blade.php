@extends('layouts.master')

@section('title', 'Detail Barang')

@section('content')

<section class="section">

    <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('aktivitas.pinjam.show', ['id' => $item->id]) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="d-xl-none d-md-none">{{ $item_detail->unique_id }}</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
            <div class="breadcrumb-item"><a href="{{ route('panel') }}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{ route('aktivitas.pinjam.index') }}" class="text-capitalize">Peminjaman</a></div>
            <div class="breadcrumb-item">
                <a href="{{ route('aktivitas.pinjam.show', ['id' => $item->id]) }}" class="text-capitalize">
                    {{ $item->name }}
                </a>
            </div>
            <div class="breadcrumb-item active">
                {{ $item_detail->unique_id }}
            </div>
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
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                
                                {{-- <span class="badge badge-info">{{$item_detail->GetCategory->category}}</span>
                                <span class="badge badge-{{ 
                                $item_detail->stock <= 2 && $item_detail->type == 'pinjam' ? 
                                'danger' : 'success' }} ml-auto">Stok tinggal {{ $item_detail->stock }}</span>   --}}
                            {{-- </div> --}}
                        {{-- </div> 
                    </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-sm-12 mb-2">
                                <img class="mr-3 img-thumbnail" style="border: none; !important" width="450" height="350" src="{{ Storage::url($item_detail->image) }}" alt="Image barang {{ $item_detail->name }}">
                            </div>
                            <div class="col-xl-8 col-md-8 col-sm-12">
                                <h3 class="mt-2 mb-2 text-primary">{{ "$item_detail->name ($item_detail->unique_id)" }}</h3>
                            <form action="{{ route('aktivitas.pinjam.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item" value="{{$item_detail->id}}">
                                @can('admin')
                                    <div class="form-group">
                                        <label class="form-label">Pilih input user</label>
                                        <div class="selectgroup w-100">
                                            @foreach (['baru' => 'Data baru', 'lama' => 'Data dari cart'] as $i => $type)
                                            <label class="selectgroup-item selectgroup-type" data-type="{{ $i }}">
                                                <input type="radio" name="type" value="{{ $i }}" class="form-control selectgroup-input type-input" @if($i == 'baru' || old('type') == "lama") checked @endif>
                                                <span class="selectgroup-button text-capitalize">{{ $type }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group form-activity">
                                        <div class="form-activity-item" data-activity="baru">
                                            <label>Pilih user</label>
                                            <select class="form-control text-capitalize @error('user') is-invalid @enderror" name="user">
                                                <option value="">Pilih</option>
                                                @foreach ($users as $user)
                                                    <option 
                                                        value="{{ $user->id }}" 
                                                        class="text-capitalize" 
                                                        @if ( $user->id == old('user') ) 
                                                            selected 
                                                        @endif
                                                    >
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-activity-item" data-activity="lama">
                                            <label>Pilih user</label>
                                            <div class="form-group">
                                                <div class="selectgroup selectgroup-pills">
                                                    @if ( !empty(Session::get('pinjam')) )
                                                        @foreach ($users as $user)
                                                            @if ( in_array($user->id, Session::get('pinjam')) )
                                                                <label class="selectgroup-item">
                                                                    <input type="radio" name="user" value="{{ $user->id }}" class="selectgroup-input">
                                                                    <span class="selectgroup-button selectgroup-button-icon">{{ $user->name }}</span>
                                                                </label>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <p class="text-center">Tidak ada data user!</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                <div class="row">
                                    <div class="col-12">
                                        <label>Tentukan tanggal</label>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Dari</label>
                                            <input type="date" class="form-control @error('pinjam') is-invalid @enderror" name="pinjam" value="{{ old('pinjam') }}">
                                            @error('pinjam')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Sampai</label>
                                            <input type="date" class="form-control @error('kembali') is-invalid @enderror" name="kembali" value="{{ old('kembali') }}">
                                            @error('kembali')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" name="keterangan">
                                            @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right" style="padding-right: 0;">
                                    <button class="btn btn-primary text-capitalize"><i class="fas fa-shopping-cart"></i>  Tambah ke Keranjang</button>
                                </div>
                            </form>
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
        $('.form-activity-item').each(function(i, e) {
            $('.type-input').each(function(i, f) {
                if ( $(f).is(':checked') ) {
                    $(e).hide()
                    if ( $(e).attr('data-activity') == $(f).val() ) $(e).show()
                } 
            })
        })
        $('.selectgroup-type').click(function(e) {
            $('.form-activity-item').hide()
            $('select[name=user]').val()
            $('input[name=user]').prop('checked', false)
            $('.form-activity').find('[data-activity="'+$(this).attr('data-type')+'"]').show()
        })
    </script>

@endsection