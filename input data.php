<?php
include 'config.php';
session_start();
if (!isset($_SESSION['nim'])) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Data Klasemen</title>
</head>
<body>
    <form action="uefa.php" method="post">
        <label>Group:</label>
        <select name="group" required>
            <option value="A">Group A</option>
            <option value="B">Group B</option>
            <option value="C">Group C</option>
            <option value="D">Group D</option>
        </select><br>
        <label>Negara:</label>
        <select name="negara" required>
            <option value="Jerman">Jerman</option>
            <option value="Swiss">Swiss</option>
            <option value="Skotlandia">Skotlandia</option>
            <option value="Hongaria">Hongaria</option>
        </select><br>
        <label>Menang:</label>
        <input type="number" name="menang" required><br>
        <label>Seri:</label>
        <input type="number" name="seri" required><br>
        <label>Kalah:</label>
        <input type="number" name="kalah" required><br>
        <button type="submit" name="input_data">Masukkan Data</button>
    </form>
</body>
</html>
