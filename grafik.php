<?php
include "koneksi.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM udara");
$labels = [];
$suhuData = [];
$kelembabanData = [];
$polusiData = [];

while ($ud = mysqli_fetch_array($data)) {
    $labels[] = $ud['kualitas_udara'];
    $suhuData[] = $ud['suhu'];
    $kelembabanData[] = $ud['kelembaban'];
    $polusiData[] = $ud['polusi'];
}

// Define the ranges for good values
$goodRangeSuhu = [18, 25]; // Example: Good suhu is between 18 and 25
$goodRangeKelembaban = [40, 60]; // Example: Good kelembaban is between 40 and 60
$goodRangePolusi = [0, 20]; // Example: Good polusi is between 0 and 20
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Charts Example</title>
    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="mt-5 mb-5 fw-bold text-primary" > Grafik Laporan Kualitas Udara</h1>
    </div>
    <div style="width: 80%; margin: auto;">
        <!-- Suhu Chart -->
        <canvas id="suhuChart" style="width: 100%;"></canvas>
        <!-- Kelembaban Chart -->
        <canvas id="kelembabanChart" style="width: 100%; margin-top: 20px;"></canvas>
        <!-- Polusi Chart -->
        <canvas id="polusiChart" style="width: 100%; margin-top: 20px;"></canvas>
    </div>

    <script>
        // Suhu Chart
        var suhuCtx = document.getElementById('suhuChart').getContext('2d');
        var suhuChart = new Chart(suhuCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Suhu',
                    data: <?php echo json_encode($suhuData); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: <?php echo $goodRangeSuhu[0] - 5; ?>, // Adjust the suggested minimum
                        suggestedMax: <?php echo $goodRangeSuhu[1] + 5; ?> // Adjust the suggested maximum
                    }
                },
                annotation: {
                    annotations: [{
                        type: 'box',
                        drawTime: 'beforeDatasetsDraw',
                        xScaleID: 'x',
                        yScaleID: 'y',
                        xMin: 0,
                        xMax: <?php echo count($labels); ?>,
                        yMin: <?php echo $goodRangeSuhu[0]; ?>,
                        yMax: <?php echo $goodRangeSuhu[1]; ?>,
                        backgroundColor: 'rgba(0, 255, 0, 0.1)',
                        borderColor: 'rgba(0, 255, 0, 1)',
                        borderWidth: 2
                    }]
                }
            }
        });

        // Kelembaban Chart
        var kelembabanCtx = document.getElementById('kelembabanChart').getContext('2d');
        var kelembabanChart = new Chart(kelembabanCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Kelembaban',
                    data: <?php echo json_encode($kelembabanData); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: <?php echo $goodRangeKelembaban[0] - 5; ?>,
                        suggestedMax: <?php echo $goodRangeKelembaban[1] + 5; ?>
                    }
                },
                annotation: {
                    annotations: [{
                        type: 'box',
                        drawTime: 'beforeDatasetsDraw',
                        xScaleID: 'x',
                        yScaleID: 'y',
                        xMin: 0,
                        xMax: <?php echo count($labels); ?>,
                        yMin: <?php echo $goodRangeKelembaban[0]; ?>,
                        yMax: <?php echo $goodRangeKelembaban[1]; ?>,
                        backgroundColor: 'rgba(0, 255, 0, 0.1)',
                        borderColor: 'rgba(0, 255, 0, 1)',
                        borderWidth: 2
                    }]
                }
            }
        });

        // Polusi Chart
        var polusiCtx = document.getElementById('polusiChart').getContext('2d');
        var polusiChart = new Chart(polusiCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Polusi',
                    data: <?php echo json_encode($polusiData); ?>,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    fill: false
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: <?php echo $goodRangePolusi[0] - 5; ?>,
                        suggestedMax: <?php echo $goodRangePolusi[1] + 5; ?>
                    }
                },
                annotation: {
                    annotations: [{
                        type: 'box',
                        drawTime: 'beforeDatasetsDraw',
                        xScaleID: 'x',
                        yScaleID: 'y',
                        xMin: 0,
                        xMax: <?php echo count($labels); ?>,
                        yMin: <?php echo $goodRangePolusi[0]; ?>,
                        yMax: <?php echo $goodRangePolusi[1]; ?>,
                        backgroundColor: 'rgba(0, 255, 0, 0.1)',
                        borderColor: 'rgba(0, 255, 0, 1)',
                        borderWidth: 2
                    }]
                }
            }
        });
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>
