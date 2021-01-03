@extends('layouts.app')

@section('content')
<div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-12 col-12 order-lg-1 min-vh-100 order-md-1 bg-white">
          <div class="p-4 m-3">
            <img src="{{asset('img/bpjs.jpg')}}" alt="logo" width="200" class="mb-2 mt-2">
            
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{$error}}
                    </div>
                </div>
            @endforeach
            @endif

            <h4 class="text-dark font-weight-normal"><span class="font-weight-bold" style="color: #6777ef;">Login</span></h4>
            <p style="color: #8492f7; !important">Silakan isi email dan password anda dengan benar</p>

            <form method="POST" action="{{ url('login')}}" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                </div>
              
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Login
                    </button>
                </div>
            </form>

            <div class="text-center mt-5 text-small">
                Copyright &copy; <span id="tahun"></span> BPJS Ketenagakerjaan
            </div>
          </div>
        </div>
        {{-- kalo mau background nya jalan dari atas ke bawah pake class background-walk-y --}}
        <div class="d-none d-lg-inline col-lg-8 order-lg-2 min-vh-100 position-relative overlay-gradient-bottom" style="background-image: url('img/unsplash/admin.jpg'); background-size: cover;">
        </div>
      </div>
    </section>
  </div>

  {{-- form login yg lama --}}
  {{-- <div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand card-primary">
                        <img width="250" alt="image" src="{{asset('img/bpjs.jpg')}}" class="rounded-circle mr-1" style="border:6px solid white;">

                    </div>
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{$error}}
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="card card-primary">
                        <div class="card-body">

                            <form method="POST" action="{{ url('login')}}" class="needs-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email">

                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="row sm-gutters">
                            </div>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; <span id="tahun"></span> BPJS Ketenagakerjaan
                    </div>
                </div>
            </div>
    </section>
</div> --}}
@endsection