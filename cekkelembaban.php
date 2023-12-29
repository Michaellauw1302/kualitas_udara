<?php 
include "koneksi.php";
$sql = mysqli_query($conn, "SELECT * FROM udara ORDER BY id DESC");
$data = mysqli_fetch_array($sql);
$suhu = $data['kelembaban'];
echo $suhu;
