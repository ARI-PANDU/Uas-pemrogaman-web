<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL yang benar
$password = ""; // Ganti dengan password MySQL yang benar
$dbname = "uefa"; // Ganti dengan nama database yang benar

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
