<?php
include 'config.php';
session_start();
if (!isset($_SESSION['nim'])) {
    header('location: index.php');
    exit();
}

include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Klasemen UEFA 2024</title>
</head>
<body>
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
                    <a href="uefa.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
