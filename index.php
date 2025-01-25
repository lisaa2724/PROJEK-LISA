<?php
session_start();
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial pengguna
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role']; // Admin, Staf, Pengunjung
        header("Location: home.php");
    } else {
        echo "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body style="background-image:url(assets/images/bg1.jfif); background-size:cover; ">
    <div class="login">
    <br/>
    <form method="POST" action="">
        <div class="form-group">
          <div class="input-group input-group-lg">
            <center><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="DodgerBlue" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <i class="bi bi-person-circle"></i></center>
            <br>
             Username  <input class="form-control" name="username" type="text" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group input-group-lg">
            Password  <input class="form-control" name="password" type="password" placeholder="Password" autocomplete="off">
          </div>
        </div>
        <div class="form-group text-left">
       
    </div>
        <center><input type ="submit" value="Login" class="tombol" style="width :385px"></center>
</body>
</html>