<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Pengguna berhasil ditambahkan!";
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
            <img src="assets/images/user gear.png" style="height: 70px; width:80px ;margin: 5px;" />
            <b style="font-size: x-large; color:black ; font-family: Times New Roman;">TAMBAH PENGGUNA</b></div>
            
          <div style="color: white;
        padding: 15px 50px 5px 50px;
        float: right;
        font-size: 16px;">
          <a href="users.php"><i class="fa fa-gear" style="font-size:24px; color: black; padding-top: 14px"></i></a> &nbsp;<a href="logout.php" class="btn btn-danger square-btn-adjust" style="margin-top: -10px"><i class="fa fa-sign-out"></i> Logout</a> </div>
        </nav>
<a href="users.php" class="fa fa-arrow-left">Kembali</a>
<br>
<br>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
            <option value="Pengunjung">Pengunjung</option>
        </select><br>
        <input type="submit" value="Tambah Pengguna">
    </form>
</body>
</html>