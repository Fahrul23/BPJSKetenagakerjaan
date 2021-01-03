<nav class="scroller nicescroll mb-4">
    <a href="{{ route('user.index') }}" class="btn btn{{ $active != 'data' ? '-outline-' : '-' }}primary">Data</a>
    <a href="{{ route('user.create') }}" class="btn btn{{ $active != 'tambah' ? '-outline-' : '-' }}primary ml-3">Tambah</a>
    <a href="{{ route('user.history') }}" class="btn btn{{ $active != 'riwayat' ? '-outline-' : '-' }}primary ml-3">Riwayat</a>
</nav>