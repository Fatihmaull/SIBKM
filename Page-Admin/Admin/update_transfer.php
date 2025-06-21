<?php
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

$id = $_POST['id'] ?? null;
$status_transfer = $_POST['status_transfer'] ?? null;
$allowed = ['Belum di-transfer', 'Sudah di-transfer'];

if ($id && in_array($status_transfer, $allowed)) {
    $stmt = mysqli_prepare($koneksi, "UPDATE pengajuan_dana SET status_transfer = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $status_transfer, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "OK";
    } else {
        http_response_code(500);
        echo "Gagal update.";
    }

    mysqli_stmt_close($stmt);
} else {
    http_response_code(400);
    echo "Data tidak valid.";
}
?>
