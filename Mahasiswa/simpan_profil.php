<?php
session_start();

if (!isset($_SESSION['nim'])) {
    header("Location: ../Akses/login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_sibkm";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nim = $_SESSION['nim'];

// Upload foto jika ada
$foto_nama = "";
if (!empty($_FILES['foto']['name'])) {
    $foto_nama = uniqid() . "_" . basename($_FILES["foto"]["name"]);
    $target_file = "../Uploads/" . $foto_nama;
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
}

$query = "REPLACE INTO mahasiswa (
    nim, jenis_kelamin, tanggal_lahir, whatsapp, email, jurusan, fakultas,
    angkatan, rekening, semester, ips, ipk, dosen_pembimbing,
    nama_ayah, pekerjaan_ayah, nama_ibu, pekerjaan_ibu, pendapatan_orangtua, foto
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param(
    "ssssssssiddsssssss",
    $nim,
    $_POST['jenis_kelamin'],
    $_POST['tanggal_lahir'],
    $_POST['whatsapp'],
    $_POST['email'],
    $_POST['jurusan'],
    $_POST['fakultas'],
    $_POST['angkatan'],
    $_POST['rekening'],
    $_POST['semester'],
    $_POST['ips'],
    $_POST['ipk'],
    $_POST['dosen_pembimbing'],
    $_POST['nama_ayah'],
    $_POST['pekerjaan_ayah'],
    $_POST['nama_ibu'],
    $_POST['pekerjaan_ibu'],
    $_POST['pendapatan_orangtua'],
    $foto_nama
);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan!'); window.location.href='profil.php';</script>";
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}

$stmt->close();
$conn->close();