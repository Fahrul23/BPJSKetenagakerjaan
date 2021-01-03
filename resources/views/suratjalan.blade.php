  @extends('layouts.master')

  @section('title', 'Surat Jalan')

  @section('content') 
  <section class="section">

    <div class="section-header">
      <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1 class=" d-xl-none d-md-none">Surat Jalan</h1>
      <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
        <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
        <div class="breadcrumb-item">Surat Jalan</div>
      </div>
    </div>
    

    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        Gagal membuat surat jalan!
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
            <form method="post" action="{{ route('profile_update') }}">
              @csrf
              <div class="card-header">
                <h4>Form Surat Jalan</h4>
              </div>
              <div class="card-body">

                <!-- npp -->
                <div class="row">                               
                  <div class="form-group col-12">
                    <label>Npp</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username">
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

                <!-- nama -->
                <div class="row">
                  <div class="form-group col-12">
                    <label>Nama Karyawan</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

                <!-- waktu -->
                <div class="row">
                  <div class="form-group col-12">
                    <label>Waktu</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

                <!-- jam berangkat -->
                <div class="row">
                  <div class="form-group col-12">
                    <label>Jam Berangkat</label>
                    <input type="text" class="form-control datetimepicker">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

                <!-- keperluan -->
                <div class="row">
                  <div class="form-group col-12">
                    <label>Keperluan</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

