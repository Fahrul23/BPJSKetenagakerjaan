<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 12pt;
			border: 1px solid black;
			padding: 10px;
		}

		.mb-5 {
			margin-bottom: 5px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		.text-center {
			text-align: center;
		}
	</style>
</head>

<body>
@php
    switch (Route::currentRouteName()) {
        case 'laporan_peminjaman_export_pdf':
        	$title = 'Peminjaman Barang';
		break;
		case 'laporan_pengambilan_export_pdf':
        	$title = 'Pengambilan Barang';
		break;
		case 'laporan_pengembalian_export_pdf':
        	$title = 'Pengembalian Barang';
        break;
        default:
            $title = 'Barang';
        break;
	}
	
	$tahun = date('Y'); 
@endphp

	<div class="text-center">
		<h3>Laporan {{ $title }}</h3>
		<h3>BPJS Ketenagakerjaan Cabang Bogor</h3>
		<h3>Tahun {{ $tahun }}</h3>
	</div>

	<table class="table text-center">
		@yield('laporan')
	</table>

</body>


