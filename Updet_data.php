<?php
include 'config.php';
if (isset($_POST['update_data'])) {
    $id = $_POST['id'];
    $menang = $_POST['menang'];
    $seri = $_POST['seri'];
    $kalah = $_POST['kalah'];
    $poin = $menang * 3 + $seri;

    $stmt = $conn->prepare("UPDATE klasemen SET menang = ?, seri = ?, kalah = ?, poin = ? WHERE id = ?");
    $stmt->bind_param("iiiii", $menang, $seri, $kalah, $poin, $id);
    $stmt->execute();
    $stmt->close();

    header('location: klasemen.php');
}