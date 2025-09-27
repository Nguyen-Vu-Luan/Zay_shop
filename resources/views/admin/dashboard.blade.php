@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- Thống kê số liệu --}}
    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Người dùng</h5>
                <p class="fs-4 fw-bold">{{ $stats['users'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Sản phẩm</h5>
                <p class="fs-4 fw-bold">{{ $stats['products'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Đơn hàng</h5>
                <p class="fs-4 fw-bold">{{ $stats['orders'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Doanh thu</h5>
                <p class="fs-4 fw-bold text-success">
                    {{ number_format($stats['revenue'], 0, ',', '.') }} VNĐ
                </p>
            </div>
        </div>
    </div>

    {{-- Biểu đồ doanh thu --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fa fa-chart-line me-2"></i> Thống kê doanh thu</h5>
        </div>
        <div class="card-body text-center">
            <div class="mb-3">
                <label for="chartType" class="form-label">Chọn loại biểu đồ:</label>
                <select id="chartType" class="form-select w-auto d-inline-block">
                    <option value="bar">Cột</option>
                    <option value="line">Đường</option>
                    <option value="pie">Tròn</option>
                </select>
            </div>

            {{-- Biểu đồ nhỏ gọn --}}
            <div style="max-width: 400px; margin: 0 auto;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        let chartType = 'bar';
        let chart;

        function renderChart(type) {
            if (chart) chart.destroy();
            chart = new Chart(ctx, {
                type: type,
                data: {
                    labels: ['Tổng doanh thu'],
                    datasets: [{
                        label: 'Doanh thu',
                        data: [{{ $stats['revenue'] }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(54, 162, 235, 0.6)'
                        ],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: type === 'pie' ? 1 : 2, // Pie nhỏ gọn hơn
                    plugins: {
                        legend: { display: true, position: 'bottom' }
                    }
                }
            });
        }

        renderChart(chartType);

        document.getElementById('chartType').addEventListener('change', function () {
            chartType = this.value;
            renderChart(chartType);
        });
    </script>
@endsection