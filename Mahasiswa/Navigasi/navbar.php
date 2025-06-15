<?php
if (session_status () === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['nim'])) {
    header("Location: ../Akses/login.php");
    exit;
}

$nim = $_SESSION['nim'];

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_sibkm";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil nama_lengkap dari tabel users
$query_user = "SELECT nama_lengkap FROM users WHERE nim = ?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("s", $nim);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$data_user = $result_user->fetch_assoc();
$nama_lengkap = $data_user['nama_lengkap'] ?? '-';
$stmt_user->close();

// Ambil foto dari tabel mahasiswa
$query_foto = "SELECT foto FROM mahasiswa WHERE nim = ?";
$stmt_foto = $conn->prepare($query_foto);
$stmt_foto->bind_param("s", $nim);
$stmt_foto->execute();
$result_foto = $stmt_foto->get_result();
$data_foto = $result_foto->fetch_assoc();
$foto = $data_foto['foto'] ?? '';
$stmt_foto->close();

// Set path foto
$foto_path = $foto ? "../Uploads/" . $foto : "../Gambar/foto.jpg";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigasi Bar</title>
    <!-- Style -->
    <link rel="stylesheet" href="../Style/navigasi.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
</head>
<body>
    <!-- Navigasi Bar Start -->
    <nav id="navbar">
        <span id="logo">SLMS</span>

        <div class="navbar-right">
            <span class="material-symbols-outlined icon">menu</span>

            <div class="username">
                <p><?= htmlspecialchars($nim) ?></p>
                <p><?= htmlspecialchars($nama_lengkap) ?></p>
                <img src="<?= htmlspecialchars($foto_path) ?>" alt="Foto Profil" />
            </div>
        </div>
    </nav>
    <!-- Navigasi Bar End -->
</body>
</html>