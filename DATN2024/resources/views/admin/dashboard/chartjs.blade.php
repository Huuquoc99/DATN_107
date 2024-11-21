
<form action="{{ route('statistics') }}" method="GET">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

    <button type="submit">Filter</button>
</form>


<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($statistics->pluck('month_year')); 
    const data = @json($statistics->pluck('total_quantity_sold'));
    const revenueData = @json($statistics->pluck('total_revenue'));

    const config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Number of products sold',
                    data: data,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                },
                {
                    label: 'Revenue',
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
