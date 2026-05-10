<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
    exit();
}

require 'koneksi.php';
$isAdmin = ($_SESSION['nama'] === 'admin');

if ($isAdmin && isset($_GET['delete'])) {
    $id_delete = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id_delete);
    $stmt->execute();
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h2>

    <a href="logout.php"><button>Logout</button></a><hr>

    <?php if ($isAdmin): ?>
        <h3>Menu Admin: Kelola Pengguna</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
            <?php
            $result = $conn->query("SELECT id, nama FROM users");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "'><button>Edit</button></a>
                        <a href='dashboard.php?delete=" . $row['id'] . "'><button>Hapus</button></a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    <?php endif; ?>    
</body>
</html>