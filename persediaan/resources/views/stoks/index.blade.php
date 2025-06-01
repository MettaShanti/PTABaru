@extends('layouts.main')

@section('content')

@if(session('stok_alert'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!sessionStorage.getItem('stok_alert_shown')) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan Stok Expired',
                html: {!! json_encode(session('stok_alert')) !!},
                confirmButtonText: 'Lihat Detail',
                confirmButtonColor: '#f59e0b',
                cancelButtonText: 'Tutup',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('stoks.expired') }}";
                }
            });

            sessionStorage.setItem('stok_alert_shown', 'true');

            // Kirim request ke server untuk menghapus session alert (agar tidak permanen)
            fetch("{{ route('stok.clear-alert') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
        }
    });
</script>
@endif



<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Data Stok</h2>
    <a href="{{ route('stoks.expired') }}" class="btn btn-warning position-relative">
        <i class="fas fa-exclamation-triangle me-1"></i> Produk Expired
        @if(session('notif_count', 0) > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ session('notif_count') }}
        </span>
        @endif
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
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
            @forelse($stoks as $stok)
                @php
                    $exp = \Carbon\Carbon::parse($stok->tgl_exp_terakhir);
                    $today = now();
                    $rowClass = '';

                    if ($exp->lt($today)) {
                        $rowClass = 'table-danger';
                    } elseif ($exp->lte($today->copy()->addDays(21))) {
                        $rowClass = 'table-warning';
                    }
                @endphp
                <tr class="{{ $rowClass }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $stok->kode_produk }}</td>
                    <td>{{ $stok->nama_produk }}</td>
                    <td>{{ $stok->jenis }}</td>
                    <td>{{ $stok->satuan }}</td>
                    <td class="text-end">{{ $stok->total_masuk }}</td>
                    <td class="text-end">{{ $stok->total_keluar }}</td>
                    <td class="text-end fw-bold">{{ $stok->stok_akhir }}</td>
                    <td>{{ $stok->tgl_produksi_terakhir }}</td>
                    <td>{{ $stok->tgl_exp_terakhir }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data stok tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
