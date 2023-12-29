<body>
    <?php
    include "header.php";
    include "koneksi.php";
    ?>
    <div class="container mt-5">
        <h1 class="text-primary fw-bold">LoG Data</h1>
        <a href="hapus_log.php" class="btn btn-primary">Hapus Data</a>
        <a href="download_excel.php" class="btn btn-success">Download Excel</a>

    </div>

    <div class="container mt-5">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Suhu</th>
                    <th>Kelembaban</th>
                    <th>Polusi</th>
                    <th>Result</th>
                    <th>waktu</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $batas = 20;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = mysqli_query($conn, "select * from udara");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);
                $udara  = mysqli_query($conn, "SELECT * FROM udara LIMIT $halaman_awal, $batas");
                $no = $halaman_awal + 1;
                $waktu = date("Y-d-m H:i:s");
                while ($ud = mysqli_fetch_array($udara)) {
                ?>
                    <tr>

                        <td><?= $no++ ?></td>
                        <td><?= $ud['suhu'] ?></td>
                        <td><?= $ud['kelembaban'] ?></td>
                        <td><?= $ud['polusi'] ?></td>
                        <td><?= $ud['kualitas_udara'] ?></td>
                        <td><?= $waktu ?></td>
                    </tr>

                <?php } ?>
                </tr>
            </tbody>

            <nav>
                <ul class="pagination justify-content-center">

                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman > 1) {
                                                    echo "href='?halaman=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>

                    <?php
                    }
                    ?>
                 
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </table>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>