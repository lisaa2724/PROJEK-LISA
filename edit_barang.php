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

$id = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $kondisi = $_POST['kondisi'];
    $deskripsi = $_POST['deskripsi'];
    $tahun_pengadaan = $_POST['tahun_pengadaan'];

    // Cek apakah gambar baru diupload
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target = "assets/images/" . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
        $sql = "UPDATE barang SET nama_barang='$nama_barang', stok='$stok', kondisi='$kondisi', gambar='$gambar', deskripsi='$deskripsi', tahun_pengadaan='$tahun_pengadaan' WHERE id=$id";
    } else {
        $sql = "UPDATE barang SET nama_barang='$nama_barang', stok='$stok', kondisi='$kondisi', deskripsi='$deskripsi', tahun_pengadaan='$tahun_pengadaan' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Barang berhasil diupdate!";
        header("Location: home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
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
            <img src="assets/images/folder edit.png" style="height: 70px; width:80px ;margin: 5px;" />
            <b style="font-size: x-large; color:black ; font-family: Times New Roman;">EDIT BARANG</b></div>
            
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
        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required><br>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required><br>
        <label for="kondisi">Kondisi:</label>
        <select name="kondisi" required>
            <option value="Baik" <?php if($row['kondisi'] == 'Baik') echo 'selected'; ?>>Baik</option>
            <option value="Rusak" <?php if($row['kondisi'] == 'Rusak') echo 'selected'; ?>>Rusak</option>
            <option value="Perlu Perbaikan" <?php if($row['kondisi'] == 'Perlu Perbaikan') echo 'selected'; ?>>Perlu Perbaikan</option>
        </select><br>
        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar"><br>
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea><br>
        <label for="tahun_pengadaan">Tahun Pengadaan:</label>
        <input type="number" name="tahun_pengadaan" value="<?php echo $row['tahun_pengadaan']; ?>" required><br>
        <input type="submit" value="Update Barang">
    </form>
    
</body>
</html>