<?php
include 'includes/config.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Cek hak akses
if ($_SESSION['role'] != 'Admin') {
    echo "Anda tidak memiliki akses ke halaman ini. Silahkan login sebagai Admin!!";
    exit();
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
            <img src="assets/images/user.png" style="height: 70px; width:80px ;margin: 5px;" />
            <b style="font-size: x-large; color:black ; font-family: Times New Roman;">DAFTAR PENGGUNA</b></div>
            
          <div style="color: white;
        padding: 15px 50px 5px 50px;
        float: right;
        font-size: 16px;">
          <a href="users.php"><i class="fa fa-gear" style="font-size:24px; color: black; padding-top: 14px"></i></a> &nbsp;<a href="logout.php" class="btn btn-danger square-btn-adjust" style="margin-top: -10px"><i class="fa fa-sign-out"></i> Logout</a> </div>
        </nav>
     <a href="home.php" class="fa fa-arrow-left">Kembali</a>
     <br>
     <br>   
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='delete_user.php?id={$row['id']}'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada pengguna</td></tr>";
        }
        ?>
    </table>
    <a href="tambah_users.php">Tambah Pengguna</a>
</body>
</html>