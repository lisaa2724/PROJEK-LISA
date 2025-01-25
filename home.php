<?php
include 'includes/config.php';
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
            <img src="assets/images/home.png" style="height: 70px; width:80px ;margin: 5px;" />
            <b style="font-size: x-large; color:black ; font-family: Times New Roman;">SISTEM INVENTARIS</b></div>
            
          <div style="color: white;
        padding: 15px 50px 5px 50px;
        float: right;
        font-size: 16px;">
          <a href="users.php"><i class="fa fa-gear" style="font-size:24px; color: black; padding-top: 14px"></i></a> &nbsp;<a href="logout.php" class="btn btn-danger square-btn-adjust" style="margin-top: -10px"><i class="fa fa-sign-out"></i> Logout</a> </div>
        </nav> 

    <a href="add_barang.php"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</button></a>
    <br>
    <br>
    <div>
    <form action="" method="GET" >
    <input type="text" name="search" placeholder="Cari barang..." required>
    <select name="kondisi">
        <option value="">Semua Kondisi</option>
        <option value="Baik">Baik</option>
        <option value="Rusak">Rusak</option>
        <option value="Perlu Perbaikan">Perlu Perbaikan</option>
    </select>
    <input type="submit" value="Cari">
</form>
</div>
</div>
<?php

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$search%'";
$result = $conn->query($sql);

$kondisi_filter = isset($_GET['kondisi']) ? $_GET['kondisi'] : '';
$sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$search%'";
if ($kondisi_filter) {
    $sql .= " AND kondisi='$kondisi_filter'";
}
$result = $conn->query($sql);
?>
    <div class="panel-body" style="font-family:Times New Roman ">
        <div class="table-responsive" >
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">Nama Barang</th>
            <th style="text-align: center">Stok</th>
            <th style="text-align: center">Kondisi</th>
            <th style="text-align: center">Gambar</th>
            <th style="text-align: center">Deskripsi</th>
            <th style="text-align: center">Tahun Pengadaan</th>
            <th style="text-align: center">Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM barang";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['stok']}</td>
                        <td>{$row['kondisi']}</td>
                        <td><img src='assets/images/{$row['gambar']}' width='100'></td>
                        <td>{$row['deskripsi']}</td>
                        <td>{$row['tahun_pengadaan']}</td>
                        <td>
                            <a href='edit_barang.php?id={$row['id']}'>Edit</a>
                            <a href='delete_barang.php?id={$row['id']}'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
        }

        ?>

    </table>
    <a href="export.php"><button class="button" style="margin-top: 15px;"><l class="fa fa-file" style="color: black;"> Cetak MS.Excel</l></button></a>
</div>

 <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>