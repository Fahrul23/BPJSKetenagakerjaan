@extends('layouts.master')

@section('title', 'Password')

@section('content')
<section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
      <a href="{{ route('setting') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1 class=" d-xl-none d-md-none">Password</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
      <div class="breadcrumb-item"><a href="{{route('setting')}}">Setting</a></div>
      <div class="breadcrumb-item">Password</div>
    </div>
  </div>

  @if ( $errors->any() )
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      Gagal mengubah password!
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
      <div class="col-md-6 col-xl-6 col-12">
        <div class="card">
          <form method="post" class="needs-validation" novalidate="" action="{{ route('password_update') }}">
            @csrf
            <div class="card-header">
              <h4>Ubah Password</h4>
            </div>
            <div class="card-body">
                <div class="row">                               
                  <div class="form-group col-12">
                    <label>Password baru</label>
                    <input type="password" class="form-control @error('pass_new') is-invalid @enderror" name="pass_new" required="">
                    @error('pass_new')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-12">
                    <label>Ketik ulang password</label>
                    <input type="password" class="form-control @error('pass') is-invalid @enderror" name="pass" required="">
                    @error('pass')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection