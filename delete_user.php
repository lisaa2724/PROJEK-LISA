<?php
include 'includes/config.php';

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "User berhasil dihapus!";
    header("Location: users.php");
} else {
    echo "Error: " . $conn->error;
}
?>