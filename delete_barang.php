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
$sql = "DELETE FROM barang WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Barang berhasil dihapus!";
    header("Location: home.php");
} else {
    echo "Error: " . $conn->error;
}
?>