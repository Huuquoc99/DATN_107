<!-- Form lọc -->
<form action="{{ route('statistics') }}" method="GET">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

    <button type="submit">Filter</button>
</form>

<!-- Biểu đồ -->
<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dữ liệu từ controller (đã được chuyển sang JSON)
    const labels = @json($statistics->pluck('month_year'));  // Lấy tháng/năm
    const data = @json($statistics->pluck('total_quantity_sold'));  // Lấy số lượng bán ra
    const revenueData = @json($statistics->pluck('total_revenue'));  // Lấy doanh thu

    const config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Số lượng sản phẩm đã bán',
                    data: data,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                },
                {
                    label: 'Doanh thu',
                    data: revenueData,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    // Khởi tạo biểu đồ
    new Chart(document.getElementById('myChart'), config);
</script>
