<?php
// Mengambil data dari ESP32
$suhu = $_GET['suhu'];
$kelembaban = $_GET['kelembaban'];
$polusi = $_GET['polusi'];
$kualitas_udara = $_GET['kualitas_udara'];

// Konfigurasi database MySQL
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "kualitas_udara"; // Ganti dengan nama database Anda

// Membuat koneksi ke database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyiapkan dan mengeksekusi query SQL untuk menyimpan data
$sql = "INSERT INTO udara (suhu, kelembaban, polusi, kualitas_udara) VALUES ($suhu, $kelembaban, $polusi,$kualitas_udara)";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi ke database
$conn->close();
