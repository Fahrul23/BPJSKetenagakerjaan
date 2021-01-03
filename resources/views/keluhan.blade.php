  @extends('layouts.master')

  @section('title', 'Keluhan')

  @section('content') 
  <section class="section">

    <div class="section-header">
      <div class="section-header-back d-md-none">
        <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1 class=" d-xl-none d-md-none">Keluhan</h1>
      <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
        <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
        <div class="breadcrumb-item">Keluhan</div>
      </div>
    </div>
    

    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        Gagal membuat keluhan!
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
                <h4>Form Keluhan</h4>
              </div>
              <div class="card-body">

                <!-- Judul -->
                <div class="row">                               
                  <div class="form-group col-12">
                    <label>Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul">
                    @error('judul')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

                <!-- Detail Keluhan -->
                <div class="row">                               
                  <div class="form-group col-12">
                    <label>Detail Keluhan</label>
                    <textarea class="form-control @error('detail_keluhan') is-invalid @enderror" name="detail_keluhan">
                    @error('detail_keluhan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                    </textarea>
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

