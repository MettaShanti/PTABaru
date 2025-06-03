@extends('layouts.main')

@section('content')

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('produkTrendChart').getContext('2d');

    const labels = {!! json_encode($labels) !!};
    const stokData = {!! json_encode($stokData->values()) !!};
    const produkMasukData = {!! json_encode($produkMasukData->values()) !!};
    const produkKeluarData = {!! json_encode($produkKeluarData->values()) !!};

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Stok Akhir',
                    data: stokData,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4
                },
                {
                    label: 'Produk Masuk',
                    data: produkMasukData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4
                },
                {
                    label: 'Produk Keluar',
                    data: produkKeluarData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                },
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Unit'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nama Produk'
                    }
                }
            }
        }
    });
</script>
@endsection
