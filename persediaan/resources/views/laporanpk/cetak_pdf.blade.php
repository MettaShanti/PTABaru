<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk Keluar</title>
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
    <div class="printed-date">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

    <h3 style="text-align:center;">Laporan Produk Keluar</h3>

    <table>
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produkKeluar as $pk)
            <tr>
                <td>{{ $pk->produk->kode_produk ?? '-' }}</td>
                <td>{{ $pk->produk->nama_produk ?? '-' }}</td>
                <td>{{ $pk->tgl_keluar }}</td>
                <td>{{ $pk->jumlah }}</td>
                <td>{{ $pk->satuan }}</td>
                <td>{{ $pk->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
