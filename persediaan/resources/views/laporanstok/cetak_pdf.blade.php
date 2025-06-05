<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Stok Produk</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

    <h2>Laporan Stok Produk</h2>

    <div class="printed-date">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

    @if ($request->nama_produk)
        <p><strong>Filter Nama Produk:</strong> {{ $request->nama_produk }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Jenis</th>
                <th>Satuan</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
                <th>Stok Akhir</th>
                <th>Tgl Produksi Terakhir</th>
                <th>Tgl Exp Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stokList as $stok)
                <tr>
                    <td>{{ $stok->kode_produk }}</td>
                    <td>{{ $stok->nama_produk }}</td>
                    <td>{{ $stok->jenis }}</td>
                    <td>{{ $stok->satuan }}</td>
                    <td>{{ $stok->total_masuk }}</td>
                    <td>{{ $stok->total_keluar }}</td>
                    <td>{{ $stok->stok_akhir }}</td>
                    <td>{{ \Carbon\Carbon::parse($stok->tgl_produksi_terakhir)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($stok->tgl_exp_terakhir)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data stok</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
