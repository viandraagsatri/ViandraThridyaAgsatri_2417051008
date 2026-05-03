<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $npm = mysqli_real_escape_string($conn, $_POST['npm']);
    mysqli_query($conn, "INSERT INTO mahasiswa (nama, npm) VALUES ('$nama', '$npm')");
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $npm = mysqli_real_escape_string($conn, $_POST['npm']);
    mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama', npm='$npm' WHERE id='$id'");
    header("Location: index.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id='$id'");
    header("Location: index.php");
    exit();
}

$edit_data = null;
if (isset($_GET['edit'])) {
    $id = mysqli_real_escape_string($conn, $_GET['edit']);
    $query_edit = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
    $edit_data = mysqli_fetch_assoc($query_edit);
}

$data = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head><title>CRUD Mahasiswa</title></head>
<body>
<h2>Data Mahasiswa</h2>

<form method="POST">
    <?php if ($edit_data): ?>
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
    <?php endif; ?>

    Nama: <input type="text" name="nama" value="<?= $edit_data ? $edit_data['nama'] : '' ?>" required>
    NPM: <input type="text" name="npm" value="<?= $edit_data ? $edit_data['npm'] : '' ?>" required>
    
    <?php if ($edit_data): ?>
        <button type="submit" name="update">Update</button>
    <?php else: ?>
        <button type="submit" name="tambah">Tambah</button>
    <?php endif; ?>
</form>
<br>

<table border="1" cellpadding="5">
    <tr><th>No</th><th>Nama</th><th>NPM</th><th>Aksi</th></tr>
    <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['npm']) ?></td>
        <td>
            <a href="?edit=<?= $row['id'] ?>">Edit</a> | 
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>