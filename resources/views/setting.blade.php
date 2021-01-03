  @extends('layouts.master')

  @section('title', 'Setting')

  @section('content')

    <section class="section">

      <div class="section-header">
        <div class="section-header-back d-md-none">
            <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class=" d-xl-none d-md-none">Setting</h1>
        <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
          <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
          <div class="breadcrumb-item">Setting</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Setting</h2>
        <p class="section-lead">
          Pengaturan user akun.
        </p>
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-large-icons">
              <div class="card-icon bg-primary text-white">
                <i class="fas fa-user"></i>
              </div>
              <div class="card-body">
                <h4>Profile</h4>
                <p>Setting username dan email.</p>
                <a href="{{ route('profile', ['id' => Auth::id()]) }}" class="card-cta">Ubah Setting <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card card-large-icons">
              <div class="card-icon bg-primary text-white">
                <i class="fas fa-lock"></i>
              </div>
              <div class="card-body">
                <h4>Password</h4>
                <p>Ubah password.</p>
                <a href="{{ route('password', ['id' => Auth::id()]) }}" class="card-cta">Ubah Setting <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section>

  @endsection