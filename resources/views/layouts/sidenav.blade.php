<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('panel')}}"><img alt="image" src="{{asset('img/logo/bpjs.jpg')}}" style="width:140px;">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('panel')}}">BPJS</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Menu</li>
            <li class="{{ Route::currentRouteName() == 'panel' ? 'active' : '' }}"><a class="nav-link" href="{{route('panel')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

            {{-- user --}}
            @can('user')

                <li class="dropdown {{ in_array(Route::currentRouteName(), ['aktivitas.pinjam.index', 'aktivitas.pinjam.detail', 'aktivitas.pinjam.show', 'aktivitas.ambil.index', 'aktivitas.ambil.show']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-alt"></i> <span>Aktivitas</span></a>
                    <ul class="dropdown-menu">
                        <li 
                            class="{{ in_array(Route::currentRouteName(), ['aktivitas.pinjam.index', 'aktivitas.pinjam.detail', 'aktivitas.pinjam.show'])? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('aktivitas.pinjam.index') }}">Peminjaman</a>
                        </li>
                        <li 
                            class="{{ in_array(Route::currentRouteName(), ['aktivitas.ambil.index', 'aktivitas.ambil.show'])? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('aktivitas.ambil.index') }}">Pengambilan</a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="{{ in_array(Route::currentRouteName(), ['aktivitas.pinjam.index', 'aktivitas.pinjam.detail', 'aktivitas.pinjam.show']) ? 'active' : '' }}"><a class="nav-link" href="{{route('aktivitas.pinjam.index')}}"><i class="fas fa-book"></i> <span>Peminjaman</span></a></li>
                <li class="{{ in_array(Route::currentRouteName(), ['aktivitas.ambil.index', 'aktivitas.ambil.show']) ? 'active' : '' }}"><a class="nav-link" href="{{route('aktivitas.ambil.index')}}"><i class="fas fa-pencil-alt"></i> <span>Pengambilan</span></a></li> --}}
                <li class="dropdown {{ in_array(Route::currentRouteName(), ['riwayat.ambil.show', 'riwayat.pinjam.index', 'riwayat.ambil.index', 'riwayat.pinjam.show', 'riwayat.kembali.index']) ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-history"></i> <span>Riwayat</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ in_array(Route::currentRouteName(), ['riwayat.pinjam.index','riwayat.pinjam.show']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat.pinjam.index') }}">Peminjaman</a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['riwayat.ambil.index', 'riwayat.ambil.show']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat.ambil.index') }}">Pengambilan</a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['riwayat.kembali.index', 'riwayat.kembali.kondisi']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat.kembali.index') }}">Pengembalian</a></li>
                    </ul>
                </li>
                {{-- <li class="{{ Route::currentRouteName() == 'suratjalan' ? 'active' : '' }}"><a class="nav-link" href="{{route('suratjalan')}}"><i class="far fa-envelope"></i> <span>Surat Jalan</span></a></li>
                <li class="{{ Route::currentRouteName() == 'keluhan' ? 'active' : '' }}"><a class="nav-link" href="{{route('keluhan')}}"><i class="far fa-angry"></i> <span>Keluhan</span></a></li> --}}

            @endcan

            {{-- admin --}}
            @can('admin')

                <li class="dropdown {{ in_array(Route::currentRouteName(), ['aktivitas.pinjam.index', 'aktivitas.pinjam.detail', 'aktivitas.pinjam.show', 'aktivitas.ambil.index', 'aktivitas.ambil.show']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-alt"></i> <span>Aktivitas</span></a>
                    <ul class="dropdown-menu">
                        <li 
                            class="{{ in_array(Route::currentRouteName(), ['aktivitas.pinjam.index', 'aktivitas.pinjam.detail', 'aktivitas.pinjam.show'])? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('aktivitas.pinjam.index') }}">Peminjaman</a>
                        </li>
                        <li 
                            class="{{ in_array(Route::currentRouteName(), ['aktivitas.ambil.index', 'aktivitas.ambil.show'])? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('aktivitas.ambil.index') }}">Pengambilan</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown {{ in_array(Route::currentRouteName(), ['barang.pinjam.index', 'barang.pinjam.tambah', 'barang.pinjam.riwayat', 'barang.pinjam.show', 'barang.ambil.index', 'barang.ambil.tambah', 'barang.ambil.riwayat', 'barang.ambil.detail','barang.ambil.habis', 'kategori', 'kategori_tambah', 'kategori_riwayat']) ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-box-open"></i> <span>Barang</span></a>
                    <ul class="dropdown-menu">

                        <li class="{{ in_array(Route::currentRouteName(), ['barang.pinjam.index', 'barang.pinjam.tambah', 'barang.pinjam.riwayat', 'barang.pinjam.show']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('barang.pinjam.index') }}">Aset</a>
                        </li>

                        <li class="{{ in_array(Route::currentRouteName(), ['barang.ambil.index', 'barang.ambil.tambah', 'barang.ambil.riwayat', 'barang.ambil.detail', 'barang.ambil.habis']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('barang.ambil.index') }}">Consumable</a>
                        </li>

                        <li class="{{ in_array(Route::currentRouteName(), ['kategori', 'kategori_tambah', 'kategori_riwayat']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('kategori') }}">Kategori Barang</a></li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.history']) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fas fa-user"></i> <span>User</span>
                    </a>
                </li>

                <li class="dropdown {{ in_array(Route::currentRouteName(), ['riwayat.ambil.show', 'riwayat.pinjam.index', 'riwayat.ambil.index', 'riwayat.pinjam.show', 'riwayat.kembali.index', 'riwayat.kembali.kondisi']) ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-history"></i> <span>Riwayat</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ in_array(Route::currentRouteName(), ['riwayat.pinjam.index','riwayat.pinjam.show']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat.pinjam.index') }}">Peminjaman</a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['riwayat.ambil.index', 'riwayat.ambil.show']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat.ambil.index') }}">Pengambilan</a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['riwayat.kembali.index', 'riwayat.kembali.kondisi']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('riwayat.kembali.index') }}">Pengembalian</a></li>
                    </ul>
                </li>

                <li class="dropdown {{ in_array(Route::currentRouteName(), ['laporan_barang', 'laporan_peminjaman', 'laporan_peminjaman_detail', 'laporan_pengambilan', 'laporan_pengambilan_detail', 'laporan_pengembalian', 'laporan_pengembalian_detail']) ? 'active' : '' }}">
                    <a class="nav-link has-dropdown" href="#"><i class="far fa-chart-bar"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ in_array(Route::currentRouteName(),['laporan_peminjaman', 'laporan_peminjaman_detail'])  ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan_peminjaman') }}">Peminjaman</a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['laporan_pengambilan', 'laporan_pengambilan_detail']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan_pengambilan') }}">Pengambilan</a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['laporan_pengembalian', 'laporan_pengembalian_detail']) ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan_pengembalian') }}">Pengembalian</a></li>
                        {{-- <li class="{{ Route::currentRouteName() == 'laporan_barang' ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan_barang') }}">Barang</a></li> --}}
                    </ul>
                </li>
            @endcan

        </ul>

    </aside>
</div>