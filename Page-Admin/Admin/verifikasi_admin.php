<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sibkm";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    http_response_code(500);
    echo "Koneksi gagal.";
    exit;
}

$password_input = $_POST['password'] ?? '';

// Ambil 1 user admin dari database
$query = mysqli_query($koneksi, "SELECT password FROM users WHERE role = 'admin' LIMIT 1");

if ($query && mysqli_num_rows($query) === 1) {
    $user = mysqli_fetch_assoc($query);
    if (password_verify($password_input, $user['password'])) {
        echo "OK";
    } else {
        echo "SALAH";
    }
} else {
    echo "SALAH";
}
?>
