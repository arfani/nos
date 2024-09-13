<x-app-layout>
    <div class="boxes grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 mx-8">
        <div class="card bg-primary text-primary-content">
            <div class="card-body">
                <h2 class="card-title">Produk</h2>
                <p>Jumlah total produk</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-circle">{{ $data["products"] }}</button>
                </div>
            </div>
        </div>
        <div class="card bg-secondary text-secondary-content">
            <div class="card-body">
                <h2 class="card-title">Member</h2>
                <p>Jumlah total member</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-circle">{{$data["members"]}}</button>
                </div>
            </div>
        </div>
        <div class="card bg-accent text-accent-content">
            <div class="card-body">
                <h2 class="card-title">Order Hari ini</h2>
                <p>Jumlah order hari ini</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-circle">{{$data["orders_today"]}}</button>
                </div>
            </div>
        </div>
        <div class="card bg-neutral text-neutral-content">
            <div class="card-body">
                <h2 class="card-title">Order Tahun ini</h2>
                <p>Jumlah order tahun ini</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-circle">{{$data["orders_this_year"]}}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="flex m-8">
        <div class="bg-white p-6 rounded w-full md:w-2/3 lg:1/2">
            <h1 class="text-center text-2xl text-black">Data Order</h1>
            <canvas id="orders"></canvas>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        const ctx = document.getElementById('orders');
        new Chart(ctx, {
            type: 'bar', // atau 'line', sesuai dengan jenis chart yang Anda inginkan
            data: {
                labels: @json($chartData['months']), // Label bulan dari Januari hingga Desember
                datasets: [{
                    label: 'Data Order tahun ' + new Date().getFullYear(),
                    data: @json($chartData['totals']), // Data jumlah pesanan per bulan
                    backgroundColor: 'rgba(75, 192, 75, 0.2)', // Hijau
                    borderColor: 'rgba(75, 192, 75, 1)', // Hijau
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Kenaikan sumbu Y menggunakan bilangan bulat
                            callback: function(value) {
                                return Number.isInteger(value) ? value : ''; // Hanya menampilkan angka bulat
                            }
                        }
                    }
                },
                plugins: {
                    datalabels: {
                        color: '#000', // Warna teks (hitam)
                        anchor: 'end', // Penempatan label
                        align: 'start',
                        formatter: function(value) {
                            return value > 0 ? value : ''; // Jangan tampilkan jika nilainya 0
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // Pastikan plugin ChartDataLabels digunakan
        });
    </script>
    @endpush
</x-app-layout>