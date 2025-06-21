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
$status = $_POST['status'] ?? null;

$allowed_status = ['Disetujui', 'Ditolak', 'Menunggu'];

if ($id && in_array($status, $allowed_status)) {
    $stmt = mysqli_prepare($koneksi, "UPDATE pengajuan_dana SET status = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $status, $id);

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
