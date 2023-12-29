<?php
include "koneksi.php";
$sql = mysqli_query($conn, "DELETE FROM udara");
header("Location:index.php");
