@extends('layouts.master')

@section('title', 'Tambah User')

@section('content')
    
    <section class="section">
        
        <div class="section-header">
            <div class="section-header-back d-md-none">
                <a href="{{ route('panel') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1 class=" d-xl-none d-md-none">User</h1>
            <div class="section-header-breadcrumb ml-md-0 d-none d-md-flex">
                <div class="breadcrumb-item active"><a href="{{route('panel')}}">Home</a></div>
                <div class="breadcrumb-item">User</div>
                <div class="breadcrumb-item">Tambah</div>
            </div>
        </div>

        @if ( $errors->any() )
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Gagal menambahkan data user!
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

            @component('components.subnav.user')
                @slot('active')
                    tambah
                @endslot
            @endcomponent

            <div class="card">

                <form method="post">

                    @csrf
                    <div class="card-header">
                        <h4>Tambah User</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Nama User</label>

                                    <input type="text" name="name" value="{{old ('name')}}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror     
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{old ('email')}}"class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror     
                                </div>

                                <div class="form-group">
                                    <label>Role</label>

                                    <select class="form-control text-capitalize @error('role') is-invalid @enderror" name="role">
                                        <option value="">Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" @if (old('role') == $role) {{ 'selected' }} @endif class="text-capitalize">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror   

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>

        </div>
        
    </section>

@endsection
    
