<?php
include 'includes/config.php';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="data_barang.xls"');

?>
<table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Tahun Pengadaan</th>         
        </tr>
     <?php 
 
        // menampilkan data 
        $query = $_SESSION["query"];
        $data = mysqli_query($config, $query);
        while($t = mysqli_fetch_array($data)){
            $id = '\''.$tbl_barang['id'];
            $nb = '\''.$tbl_barang['nama_barang'];
            $st = '\''.$tbl_barang['stok'];
            $kd = '\''.$tbl_barang['kondisi'];
            $gb = '\''.$tbl_barang['gambar'];
            $dk = '\''.$tbl_barang['deskripsi'];
            $tp = '\''.$tbl_barang['tahun_pengadaan'];
        ?>
        <tr>
          <td><?php echo $id;?></td>
          <td><?php echo $nb;?></td>
          <td><?php echo $st;?></td>
          <td><?php echo $kd;?></td>
          <td><?php echo $gb;?></td>
          <td><?php echo $dk;?></td>
          <td><?php echo $tp;?></td>
        </tr>
        <?php 
        }
        ?>
    </table>   