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

// input data
if (isset($_POST['input_data'])) {
    $group = $_POST['group'];
    $negara = $_POST['negara'];
    $menang = $_POST['menang'];
    $seri = $_POST['seri'];
    $kalah = $_POST['kalah'];
    $poin = $menang * 3 + $seri;

    $stmt = $conn->prepare("INSERT INTO klasemen (group_, negara, menang, seri, kalah, poin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiii", $group, $negara, $menang, $seri, $kalah, $poin);
    $stmt->execute();
    $stmt->close();

    header('location: input_data.php');
}

// update data
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

// delete data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM klasemen WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header('location: klasemen.php');
}

// logout
if (isset($_GET['logout'])) {
    session_start();
    session_destroy();
    header('location: index.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>UEFA 2024</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <!-- login -->
    <form action="" method="post">
        <label>NIM:1</label>
        <input type="number" name="nim" required><br>
        <label>Password:123</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>

    <!-- input data -->
    <?php
    session_start();
    if (isset($_SESSION['nim'])): ?>
        <form action="" method="post">
            <label>Group:</label>
            <select name="group" required>
                <option value="A" selected>Group A</option>
                <option value="B">Group B</option>
                <option value="C">Group C</option>
                <option value="D">Group D</option>
            </select><br>
            <label>Negara:</label>
            <select name="negara" required>
                <option value="Jerman" selected>Jerman</option>
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
    <?php endif; ?>

    <!-- tampilkan klasemen -->
    <h2>Klasemen UEFA 2024</h2>
    <table border="1">
        <tr>
            <th>Group</th>
            <th>Negara</th>
            <th>Menang</th>
            <th>Seri</th>
            <th>Kalah</th>
            <th>Poin</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM klasemen";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['group_']; ?></td>
                <td><?php echo $row['negara']; ?></td>
                <td><?php echo $row['menang']; ?></td>
                <td><?php echo $row['seri']; ?></td>
                <td><?php echo $row['kalah']; ?></td>
                <td><?php echo $row['poin']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
