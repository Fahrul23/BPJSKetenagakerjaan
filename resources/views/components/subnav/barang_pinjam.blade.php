<nav class="scroller nicescroll mb-4">
    <a href="{{ route('barang.pinjam.index') }}" class="btn btn{{ $active != 'data' ? '-outline-' : '-' }}primary">Data</a>
    <a href="{{ route('barang.pinjam.tambah') }}" class="btn btn{{ $active != 'tambah' ? '-outline-' : '-' }}primary ml-3">Tambah</a>
    <a href="{{ route('barang.pinjam.riwayat') }}" class="btn btn{{ $active != 'riwayat' ? '-outline-' : '-' }}primary ml-3">Riwayat</a>
</nav>