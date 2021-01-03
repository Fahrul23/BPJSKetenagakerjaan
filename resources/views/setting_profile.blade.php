@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<section class="section">

  <div class="section-header">
    <div class="section-header-back d-md-none">
      <a href="{{ route('setting') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1 class=" d-xl-none d-md-none">Profile</h1>
    <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
      <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
      <div class="breadcrumb-item"><a href="{{route('setting')}}">Setting</a></div>
      <div class="breadcrumb-item">Profile</div>
    </div>
  </div>


  @if ( $errors->any() )
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      Gagal mengedit data profile!
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
          <form method="post" class="needs-validation" novalidate="" action="{{ route('profile_update') }}">
            @csrf
            <div class="card-header">
              <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">                               
                  <div class="form-group col-12">
                    <label>Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="{{ Auth::user()->name }}">
                    @error('username')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-12">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ Auth::user()->email }}">
                    @error('email')
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