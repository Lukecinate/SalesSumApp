<!DOCTYPE html>
<html>
<head>
    <title>Sales Summary</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Revenue By Item Group</h2>
        <div class="card">
            <div class="card-body">
                <canvas id="myChart1" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "/sales-summary",
                type: 'GET',
                success: function (r) {
                    if (r.status == "OK") {
                        var ctx = document.getElementById("myChart1").getContext("2d");
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: [],
                                datasets: [
                                    {
                                        label: "Revenue By Item Group",
                                        fill: false,
                                        lineTension: 0.1,
                                        backgroundColor: "rgba(75,192,192,0.4)",
                                        borderColor: "rgba(75,192,192,1)",
                                        pointBorderColor: "rgba(75,192,192,1)",
                                        pointBackgroundColor: "#fff",
                                        pointBorderWidth: 1,
                                        pointHoverRadius: 5,
                                        pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                        pointHoverBorderColor: "rgba(220,220,220,1)",
                                        pointHoverBorderWidth: 2,
                                        pointRadius: 1,
                                        pointHitRadius: 10,
                                        data: [],
                                        spanGaps: false,
                                    }
                                ]
                            },
                            options: {
                                tooltips: {
                                    mode: 'index',
                                    intersect: false
                                }
                            }
                        });
                        var labels = [];
                        var val = [];
                        $.each(r.items, function (i, a) {
                            labels.push(a.item);
                            val.push(a.revenue);
                        });
                        myChart.data.labels = labels;
                        myChart.data.datasets[0].data = val;
                        myChart.update();
                    } else {
                        alert('Error');
                    }
                }
            });
        });
    </script>
</body>
</html>
