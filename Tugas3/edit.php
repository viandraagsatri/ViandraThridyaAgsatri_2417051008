<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['nama'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_baru = trim($_POST['nama']);
    $password_baru = $_POST['password'];

    if (!empty($password_baru)) {
        $hashed_password = password_hash($password_baru, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET nama = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nama_baru, $hashed_password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET nama = ? WHERE id = ?");
        $stmt->bind_param("si", $nama_baru, $id);
    }

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        $pesan = "Gagal memperbarui data.";
    }
}

$stmt = $conn->prepare("SELECT nama FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pengguna</title>
</head>
<body>
    <h2>Edit Data Pengguna</h2>
    
    <?php if ($pesan != "") echo "<h3>$pesan</h3>"; ?>
    
    <form method="POST" action="">
        Nama Pengguna:<br>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required><br><br>
        
        Password Baru:<br>
        <input type="password" name="password" placeholder="Masukkan password baru"><br><br>
        
        <button type="submit">Simpan Perubahan</button><br><br>
        <a href="dashboard.php"><button type="button">Batal</button></a>
    </form>
</body>
</html>