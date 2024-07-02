<?php
include 'config.php'; // Mengikutsertakan file config.php

// login
if (isset($_POST['login'])) {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ? AND password = ?");
    $stmt->bind_param("ss", $nim, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['nim'] = $nim;
        header('location: input_data.php');
    } else {
        echo "Login gagal, silakan coba lagi.";
    }
    $stmt->close();
}