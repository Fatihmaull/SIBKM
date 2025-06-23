<?php
$$host = "localhost";
$user = "sibkm_user";
$pass = "Sibkm@123";
$db = "sibkm_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>