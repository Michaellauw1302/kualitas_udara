<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <title>MONITORING KUALITAS UDARA </title>

    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <!-- kodingan untuk meload data secara otomatis berbentuk javascript -->
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $('#ceksuhu').load("ceksuhu.php");
                $('#cekkelembaban').load("cekkelembaban.php");
                $('#cekpolusi').load("cekpolusi.php");
                $('#kualitasUdara').load("kualitasUdara.php");
            }, 1000);
        });
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="index.php">SemPol</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link active  text-white " aria-current="page" href="index.php">Kualitas Udara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active  text-white " aria-current="page" href="log.php">LoG Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active  text-white " aria-current="page" href="grafik.php">Grafik</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5" style="text-align: center; margin-top: 10px; margin-right:150px;">
        <div class="container mt-5 mb-5" style="margin-left: 50px;">

            <div class="row">
                <div class="col-sm-2 mb-3 mb-sm-2 rounded">
                    <div class="card">
                        <div class="card-body">
                            <img src="ubg.png" class="img-thumbnail" alt="Logo Ubg" style="width: 150px;">
                            <h5 class="card-title">Universitas Bumigora</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mt-5">

                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-primary fw-bold">Smart Polution (SemPol)</h1>
                            <h3 class="card-title fw-bold text-primary">Smart Polution Control System</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 mb-3 mb-sm-2">
                    <div class="card">
                        <div class="card-body">
                            <img src="ubg.png" class="img-thumbnail" alt="Logo Ubg" style="width: 150px;">
                            <h5 class="card-title">Teknologi Informasi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex; margin-top:10px; margin-right:100px;">

            <!-- menampilkan suhu -->
            <div class="card text-center" style="width: 50%">
                <div class="card-header" style="font-size: 20px; font-weight: bold; background-color: greenyellow;">
                    Suhu °C
                </div>
                <div class="card-body">
                    <h1><span id="ceksuhu"> 0 </span> °C</h1>
                </div>
            </div>
            <!-- akhir nilai suhu -->

            <!-- menampilkan kelembaban tanah -->
            <div class="card text-center" style="width: 50%">
                <div class="card-header" style="font-size: 20px; font-weight: bold; background-color: blue; color:white;">
                    Kelembaban Udara
                </div>
                <div class="card-body">
                    <h1><span id="cekkelembaban"> 0 </span>%</h1>
                </div>
            </div>
            <!-- akhir nilai kelembaban tanah -->

            <!-- menampilkan kel tanah -->
            <div class="card text-center" style="width: 50%">
                <div class="card-header" style="font-size: 20px; font-weight: bold; background-color: green; color:white;">
                    Presentase Polusi
                </div>
                <div class="card-body">
                    <h1><span id="cekpolusi"> 0 </span>µg/m³ </h1>
                </div>
            </div>
            <!-- akhir nilai kel tanah -->

            <!-- menampilkan kelembaban ph-->
            <div class="card text-center" style="width: 50%">
                <div class="card-header" style="font-size: 20px; font-weight: bold; background-color:skyblue; color:black;">
                    Kualitas Udara
                </div>
                <div class="card-body">
                    <h1><span id="kualitasUdara"> 0 </span> </h1>
                </div>
            </div>
            <!-- akhir nilai kelembaban ph -->

        </div>
    </div>
    <center>
        <div class="container mb-5 mt-5">
            <div class="container  mt-5">
                <h1 class="text-primary fw-bold">Grafi Perkembangan Kualitas Udara</h1>
            </div>
        </div>
    </center>

    <?php
    include "koneksi.php";

    $data = mysqli_query($conn, "SELECT * FROM udara");
    $labels = [];
    $suhuData = [];
    $kelembabanData = [];
    $polusiData = [];
    $kualitasUdaraData = [];

    while ($ud = mysqli_fetch_array($data)) {
        $labels[] = $ud['kualitas_udara'];
        $suhuData[] = $ud['suhu'];
        $kelembabanData[] = $ud['kelembaban'];
        $polusiData[] = $ud['polusi'];
        $kualitasUdaraData[] = $ud['kualitas_udara'];
    }

    // Define the ranges for good values
    $goodRangeSuhu = [18, 25]; // Example: Good suhu is between 18 and 25
    $goodRangeKelembaban = [40, 60]; // Example: Good kelembaban is between 40 and 60
    $goodRangePolusi = [0, 20]; // Example: Good polusi is between 0 and 20
    ?>


    <div style="width: 80%; margin: auto;">
        <!-- Combined Chart -->
        <canvas id="combinedChart" style="width: 100%;"></canvas>
    </div>

    <script>
        // Combined Chart
        var combinedCtx = document.getElementById('combinedChart').getContext('2d');
        var combinedChart = new Chart(combinedCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Suhu',
                    data: <?php echo json_encode($suhuData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-suhu'
                }, {
                    label: 'Kelembaban',
                    data: <?php echo json_encode($kelembabanData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-kelembaban'
                }, {
                    label: 'Polusi',
                    data: <?php echo json_encode($polusiData); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-polusi'
                }, {
                    label: 'Kualitas Udara',
                    data: <?php echo json_encode($kualitasUdaraData); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-kualitas-udara'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        id: 'y-axis-suhu',
                        type: 'linear',
                        position: 'left',
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: <?php echo $goodRangeSuhu[0] - 5; ?>,
                            suggestedMax: <?php echo $goodRangeSuhu[1] + 5; ?>
                        }
                    }, {
                        id: 'y-axis-kelembaban',
                        type: 'linear',
                        position: 'right',
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: <?php echo $goodRangeKelembaban[0] - 5; ?>,
                            suggestedMax: <?php echo $goodRangeKelembaban[1] + 5; ?>
                        }
                    }, {
                        id: 'y-axis-polusi',
                        type: 'linear',
                        position: 'left',
                        ticks: {
                            beginAtZero: true,
                            suggestedMin: <?php echo $goodRangePolusi[0] - 5; ?>,
                            suggestedMax: <?php echo $goodRangePolusi[1] + 5; ?>
                        }
                    }, {
                        id: 'y-axis-kualitas-udara',
                        type: 'linear',
                        position: 'right',
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>