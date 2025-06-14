<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sibkm";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = trim($_POST['username']);
    $nama = trim($_POST['nama']);
    $password = $_POST['password'];

    // Validasi input
    if (empty($nim) || empty($nama) || empty($password)) {
        $error = "Semua field wajib diisi!";
    } else {
        // Cek apakah NIM sudah ada
        $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE nim = '$nim'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "NIM sudah terdaftar!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = mysqli_query($koneksi, "INSERT INTO users (nim, nama_lengkap, password) VALUES ('$nim', '$nama', '$password_hash')");

            if ($insert) {
                // Redirect ke login TANPA bawa error lama
                header("Location: login.php");
                exit;
            } else {
                $error = "Pendaftaran gagal, coba lagi!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="../Style/akses.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
</head>
<body>
    <!-- Navigasi Logo Start -->
    <nav>
        <div class="logo">
            <p>SLMS</p>
            <p>Student Loan Management System</p>
        </div>

        <select>
            <option value="Id">Indonesia (id)</option>
            <option value="En">English (en)</option>
        </select>
    </nav>
    <!-- Navigasi Logo End -->

    <!-- Register Start -->
    <section class="register">
        <div class="register-text">
            <h2>Create Your</h2>
            <h2>Account</h2>
        </div>

        <div class="register-form">
            <h2>Sign Up</h2>

            <?php if (!empty($error)) : ?>
                <div style="color: red; font-size: 0.9em; margin-bottom: 10px; text-align: center;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form name="register" method="post" autocomplete="off">
                <div class="form-input username">
                    <input type="text" id="username" name="username" required>
                    <label for="username">NIM</label>
                    <span class="material-symbols-outlined">assignment_ind</span>
                </div>

                <div class="form-input nama">
                    <input type="text" id="nama" name="nama" required>
                    <label for="nama">Nama Lengkap</label>
                    <span class="material-symbols-outlined">person</span>
                </div>

                <div class="form-input password">
                    <input type="password" id="password" name="password" class="isi-password" required>
                    <label for="password">Password</label>
                    <span class="material-symbols-outlined togglePassword">lock</span>
                </div>

                <button class="register-btn" type="submit">Sign Up</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </section>
    <!-- Register End -->

    <script src="../script.js"></script>
</body>
</html>