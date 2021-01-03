<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bukti Peminjaman Barang</title>

    <style>

        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            text-transform: capitalize;
        }

        h1, h4 {
            text-transform: uppercase;
            text-align: center;
        }

        h1 {
            font-size: 1.2rem;
        }

        h4 {
            margin-top: 40px;
        }

        p {
            line-height: 9px;
        }

        .content {
            margin: 0 40px;
            margin-top: 70px;
        }

        .content .info * {
            font-size: .9rem;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .info-table, .info-table td, .assign-table, .assign-table td {
            border: none;
        }

        .item-table {
            width: 100%;
        }

        .item-table td, .item-table th {
            padding: 6px;
        }

        .assign {
            margin-top: 50px;
            width: 100%;
        }

        .assign > * {
            float: left;
        }

        .assign * {
            font-size: .9rem;
            text-align: center;
        }

        .assign-left, .assign-right {
            width: 50%;
            min-height: 120px;
        }

        .bottom {
            margin-top: 70px;
        }

        .bottom * {
            line-height: 10px;
        }
        .bold {
            font-weight: bold;
        }
    </style>

</head>
<body>
    
    <h1>peminjaman barang dan peralatan</h1>
    
    <div class="content">
        <div class="info">
            <table class="info-table">
                <tr>
                    <td>Nama</td>    
                    <td>:</td>    
                    <td>{{ $user->name }}</td>    
                </tr>    
                <tr>
                    <td>NIP</td>    
                    <td>:</td>    
                    <td>....</td>    
                </tr>    
                <tr>
                    <td>No. Telp</td>    
                    <td>:</td>    
                    <td>....</td>    
                </tr>    
                <tr>
                    <td>Tanggal Pelaksanaan</td>    
                    <td>:</td>    
                    <td>{{ $user->date_start->isoFormat('DD MMMM YYYY') }}</td>    
                </tr>    
                <tr>
                    <td>Akhir Pelaksanaan</td>    
                    <td>:</td>    
                    <td>{{ $user->date_end->isoFormat('DD MMMM YYYY') }}</td>    
                </tr>    
                <tr>
                    <td>Keterangan</td>    
                    <td>:</td>    
                    <td>{{ $user->keterangan }}</td>    
                </tr>     
            </table>            
        </div>

        <div class="item">
            <h4>daftar barang / alat yang dipinjam</h4>
            <div class="info">
                <table class="info-table">
                    <tr class="bold">
                        <td>No. Peminjaman</td>    
                        <td>:</td>    
                        <td>{{ $user->pinjam_id }}</td>    
                    </tr>   
                </table>
            </div>
            <table class="item-table">
                <thead>
                    <tr>
                        <th>no.</th>
                        {{-- <th>no. pinjam</th> --}}
                        <th>no. barang</th>
                        <th>nama barang / alat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjam as $key => $value)
                    
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            {{-- <td>{{ $value->pinjam_id }}</td> --}}
                            <td>{{ $value->item_unique_id }}</td>
                            <td>{{ $value->item_name }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="assign">
            <div class="assign-left">
                <p>yang mengajukan</p>
                <div class="bottom">
                    <p>{{ $user->name }}</p>
                    {{-- <p>NPP</p> --}}
                </div>
            </div>
            <div class="assign-right">
                {{-- <p>yang mengajukan</p> --}}
                <div>
                    <p>bogor, {{ $user->date_start->isoFormat('DD MMMM YYYY') }}</p>
                    <p>menyetujui,</p>
                    <p>Kabid Umum dan Sdm</p>
                    <div class="bottom">
                        <p>nama</p>
                        <p>NPP</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>