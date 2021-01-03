<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        {{-- <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if( !$bell['return']->isEmpty() && Route::currentRouteName() != 'riwayat_kembali' ) beep @endif">
                <i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Notifikasi
                </div>
                <div class="dropdown-list-content dropdown-list-icons is-end" tabindex="3" style="height:auto; overflow: hidden; outline: none;">
                    @if (!$bell['return']->isEmpty())
                    <a href="{{ route('riwayat_kembali') }}" class="dropdown-item">
                        <div class="dropdown-item-icon bg-danger text-white">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Peminjaman barang sudah lewat batas waktu.
                            <div class="time">{{ $bell['return']->count() }} barang.</div>
                        </div>
                    </a>
                    @else
                    <span style="width: 100%" class="dropdown-item">Tidak ada pemberitahuan</span>
                    @endif
                </div>
            </div> --}}
        </li>

        @can('admin')
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if(!$bell['peminjaman']->isEmpty() || !$bell['pengambilan']->isEmpty() ) beep @endif">
                <i class="fas fa-list-ul"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="notif">
                    <div class="col-6">
                        <a href="{{ route('konfirmasi_peminjaman') }}" class="notif-container">
                            <div class="notif-icon">
                                <i class="fas fa-book"></i>
                                @if ( !$bell['peminjaman']->isEmpty() )
                                    <span class="rounded-circle position-absolute font-weight-bold bg-danger" style="">{{ count($bell['peminjaman']) }}</span>
                                @endif
                            </div>
                            <span class="mt-3">Konfirmasi Peminjaman</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('konfirmasi_pengambilan') }}" class="notif-container">
                            <div class="notif-icon">
                                <i class="fas fa-pencil-alt"></i>
                                @if ( !$bell['pengambilan']->isEmpty() )
                                    <span class="rounded-circle position-absolute font-weight-bold bg-danger" style="">{{ count($bell['pengambilan']) }}</span>
                                @endif
                            </div>
                            <span class="mt-3">Konfirmasi Pengambilan</span>
                        </a>
                    </div>
                </div>
                {{-- <div class="dropdown-header">
                    Konfirmasi
                </div>
                <div class="dropdown-list-content dropdown-list-icons is-end" tabindex="3" style="height:auto; overflow: hidden; outline: none;">
                    <a href="{{ route('konfirmasi_peminjaman') }}" class="dropdown-item border-top">
                        <div class="dropdown-item-icon bg-primary text-white position-relative">
                            <i class="fas fa-book"></i>
                            @if ( !$bell['peminjaman']->isEmpty() )
                                <span class="rounded-circle position-absolute font-weight-bold bg-danger" style="border: 2px solid white; top: -7px; right: -5px; width: 20px; height: 20px; line-height: 18px;">{{ count($bell['peminjaman']) }}</span>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            Peminjaman
                            <div class="time">Untuk mengonfirmasi peminjaman barang.</div>
                        </div>
                    </a>
                    <a href="{{ route('konfirmasi_pengambilan') }}" class="dropdown-item border-top">
                        <div class="dropdown-item-icon bg-primary text-white position-relative">
                            <i class="fas fa-pencil-alt"></i>
                            @if ( !$bell['pengambilan']->isEmpty() )
                                <span class="rounded-circle position-absolute  font-weight-bold bg-danger" style="border: 2px solid white; top: -7px; right: -5px; width: 20px; height: 20px; line-height: 18px;">{{ count($bell['pengambilan']) }}</span>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            Pengambilan
                            <div class="time">Untuk mengonfirmasi pengambilan barang.</div>
                        </div>
                    </a>
                </div> --}}
            </div>
        </li>
        @endcan
        
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if (!empty(Session::get('ambil') || !empty(Session::get('pinjam')))) beep @endif" aria-expanded="false">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="notif">
                    <div class="col-6">
                        <a href="{{ route('cart_pinjam') }}" class="notif-container">
                            <div class="notif-icon">
                                <i class="fas fa-shopping-cart"></i>
                                @if ( !empty(Session::get('pinjam')) )
                                    <span class="rounded-circle position-absolute  font-weight-bold bg-danger" style="border: 2px solid white; top: -7px; right: -5px; width: 20px; height: 20px; line-height: 18px;">{{ count(Session::get('pinjam')) }}</span>
                                @endif
                            </div>
                            <span class="mt-3">Keranjang Peminjaman</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('cart_ambil') }}" class="notif-container">
                            <div class="notif-icon">
                                <i class="fas fa-cart-plus"></i>
                                @if ( !empty(Session::get('ambil')) )
                                    <span class="rounded-circle position-absolute  font-weight-bold bg-danger" style="border: 2px solid white; top: -7px; right: -5px; width: 20px; height: 20px; line-height: 18px;">{{ count(Session::get('ambil')) }}</span>
                                @endif
                            </div>
                            <span class="mt-3">Keranjang Pengambilan</span>
                        </a>
                    </div>
                </div>
                {{-- <div class="dropdown-header">
                    Cart
                </div>
                <div class="dropdown-list-content dropdown-list-icons is-end" tabindex="3" style="height:auto; overflow: hidden; outline: none;">
                    <a href="{{ route('cart_pinjam') }}" class="dropdown-item border-top">
                        <div class="dropdown-item-icon bg-primary text-white position-relative">
                            <i class="fas fa-book"></i>
                            @if ( !empty(Session::get('pinjam')) )
                                <span class="rounded-circle position-absolute  font-weight-bold bg-danger" style="border: 2px solid white; top: -7px; right: -5px; width: 20px; height: 20px; line-height: 18px;">{{ count(Session::get('pinjam')) }}</span>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            Peminjaman
                            <div class="time">Cart untuk data peminjaman barang.</div>
                        </div>
                    </a>
                    <a href="{{ route('cart_ambil') }}" class="dropdown-item border-top">
                        <div class="dropdown-item-icon bg-primary text-white position-relative">
                            <i class="fas fa-pencil-alt"></i>
                            @if ( !empty(Session::get('ambil')) )
                                <span class="rounded-circle position-absolute  font-weight-bold bg-danger" style="border: 2px solid white; top: -7px; right: -5px; width: 20px; height: 20px; line-height: 18px;">{{ count(Session::get('ambil')) }}</span>
                            @endif
                        </div>
                        <div class="dropdown-item-desc">
                            Pengambilan
                            <div class="time">
                                Cart untuk data pengambilan barang.
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>
        </li>

        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle notification-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block text-capitalize">Hi, {{ Str::limit(Auth::user()->name, 15) }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title overflow-hidden d-inline-block text-truncate pb-0 pt-0">
                    {{ Str::limit(Auth::user()->name, 15) }}  
                </div>
                <a href="{{ route("profile", ["id" => Auth::id()]) }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profil
                </a>
                {{-- <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a> --}}
                <a href="{{ route('setting') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger" onclick="$(this).find('form').submit()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                </a>
            </div>
        </li>
    </ul>
</nav>