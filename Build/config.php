<?php
$host = 'localhost';
$users = 'root'; 
$password = ''; 
$database = 'inventaris_db';

$conn = new mysqli($host, $users, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>