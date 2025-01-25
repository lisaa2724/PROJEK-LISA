<?php
session_start();
$host = 'localhost'; 
$db = 'inventaris_db'; 
$user = 'username'; 
$pass = 'password'; 

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk login
function login($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
    }
    return false;
}

// Cek hak akses
function checkAccess($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        header("Location: access_denied.php");
        exit();
    }
}

// Contoh penggunaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (login($username, $password)) {
        header("Location: home.php");
        exit();
    } else {
        echo "Login failed!";
    }
}

// Halaman dashboard
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        // Konten untuk admin
        echo "Welcome Admin!";
    } elseif ($_SESSION['role'] === 'staff') {
        // Konten untuk staff
        echo "Welcome Staff!";
    } elseif ($_SESSION['role'] === 'visitor') {
        // Konten untuk pengunjung
        echo "Welcome Visitor!";
    }
}
?>