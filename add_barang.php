<?php
include 'includes/config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Cek hak akses
if ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Staff' ) {
    echo "Anda tidak memiliki akses ke halaman ini. Silahkan login sebagai Admin/Staff!!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $kondisi = $_POST['kondisi'];
    $deskripsi = $_POST['deskripsi'];
    $tahun_pengadaan = $_POST['tahun_pengadaan'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target = "assets/images/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $sql = "INSERT INTO barang (nama_barang, stok, kondisi, gambar, deskripsi, tahun_pengadaan) VALUES ('$nama_barang', '$stok', '$kondisi', '$gambar', '$deskripsi', '$tahun_pengadaan')";

    if ($conn->query($sql) === TRUE) {
        echo "Barang berhasil ditambahkan!";
        header("Location: home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //validasi input
    if (empty($nama_barang) || !is_numeric($stok) || !in_array($kondisi, ['Baik', 'Rusak', 'Perlu Perbaikan'])) {
    echo "Input tidak valid!";
    exit();
}
    }
?>

<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 30;background: #FFE600;">
            <div class="navbar-header">
            </div>
            <div style="display: inline-block;vertical-align: top;">
            <img src="assets/images/tambah folder.png" style="height: 70px; width:80px ;margin: 5px;" />
            <b style="font-size: x-large; color:black ; font-family: Times New Roman;">TAMBAH BARANG</b></div>
            
          <div style="color: white;
        padding: 15px 50px 5px 50px;
        float: right;
        font-size: 16px;">
          <a href="users.php"><i class="fa fa-gear" style="font-size:24px; color: black; padding-top: 14px"></i></a> &nbsp;<a href="logout.php" class="btn btn-danger square-btn-adjust" style="margin-top: -10px"><i class="fa fa-sign-out"></i> Logout</a> </div>
        </nav>
<a href="home.php" class="fa fa-arrow-left">Kembali</a>
<br>
<br>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" required><br>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required><br>
        <label for="kondisi">Kondisi:</label>
        <select name="kondisi" required>
            <option value="Baik">Baik</option>
            <option value="Rusak">Rusak</option>
            <option value="Perlu Perbaikan">Perlu Perbaikan</option>
        </select><br>
        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar" required><br>
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br>
        <label for="tahun_pengadaan">Tahun Pengadaan:</label>
        <input type="number" name="tahun_pengadaan" required><br>
        <input type="submit" value="Tambah Barang">
    </form>
</body>
</html>