@extends('layouts.master')

@section('title', 'User')

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
        </div>
    </div>
  

    @if ( $errors->any() )
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            Terjadi kesalahan pada proses sistem!
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
            <div class="col-12 col-md-12 col-lg-12">

                @component('components.subnav.user')
                    @slot('active')
                        data
                    @endslot
                @endcomponent

                <div class="card">

                    <div class="card-header">
                        <h4>Data User</h4>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-1 text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Ditambahkan Pada</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($users as $key => $user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @php
                                                    switch ($user->role) {
                                                        case 'admin':
                                                              $badge = 'badge-info';
                                                          break;
                                                        default:
                                                              $badge = 'badge-success';
                                                          break;
                                                    }
                                                @endphp
                                                <span class="badge {{ $badge }}">{{$user->role}}</span>
                                            </td>
                                            <td>
                                                {{ $user->created_at->isoFormat('dddd, D MMMM Y') }}  
                                            </td>
                                            <td>
                                                @if ( $user->id != Auth::id() && Auth::user()->role != 'user' )
                                                    @php
                                                        switch ( Auth::user()->role ) {
                                                            case 'admin':
                                                                  $n = true;
                                                                break;
                                                            default:
                                                                  $n = true;
                                                                break;
                                                        }    
                                                    @endphp
                                                    @if ($n)
                                                        <a href="#" class="btn btn-danger" onclick="alertDelete($(this).find('form'))" data-toggle="tooltip" data-placement="top" title="Hapus User">
                                                            <i class="far fa-trash-alt"></i>
                                                            <form action="{{route('user.delete')}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                            </form>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="7">
                                                <div class="empty-state text-capitalize" data-height="400" style="min-height: 400px;">
                                                    <div class="empty-state-icon">
                                                        <i class="fas fa-question"></i>
                                                    </div>
                                                    <h2>Tidak ada data riwayat user!</h2>
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
            title: 'Kamu yakin menghapus data?',
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

@endsection