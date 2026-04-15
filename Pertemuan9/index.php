<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 9</title>
</head>
<body>
    <form method="post">
        Nama:<input type="text" id="nama" name="nama" required><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if(isset($_POST['nama'])) {
        $nama = $_POST['nama'];
        echo "Nama yang dimasukkan: " . htmlspecialchars($nama);
    }
    ?>
</body>
</html>