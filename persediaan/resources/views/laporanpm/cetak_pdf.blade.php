<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk Masuk</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background: #eee; }
        .printed-date {
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h3 style="text-align:center;">Laporan Produk Masuk</h3>


    <div class="printed-date">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div> 
    
    <table>
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Produksi</th>
                <th>Tanggal Expire</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produkMasuks as $pm)
            <tr>
                <td>{{ $pm->produk->kode_produk ?? '-' }}</td>
                <td>{{ $pm->produk->nama_produk ?? '-' }}</td>
                <td>{{ $pm->tgl_masuk }}</td>
                <td>{{ $pm->tgl_produksi }}</td>
                <td>{{ $pm->tgl_exp }}</td>
                <td>{{ $pm->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
