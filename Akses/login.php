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

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE nim = '$nim'");

    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nim'] = $user['nim'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['role'];

            // ngambil id_mahasiswa berdasarkan nim
            $nim_mahasiswa = $user['nim'];
            $q_mhs = mysqli_query($koneksi, "SELECT id FROM mahasiswa WHERE nim = '$nim_mahasiswa'");
            if (mysqli_num_rows($q_mhs) === 1) {
                $data_mhs = mysqli_fetch_assoc($q_mhs);
                $_SESSION['id_mahasiswa'] = $data_mhs['id']; 
            } else {
                $error = "Data mahasiswa tidak ditemukan.";
            }

            // redirect ke halaman profil
            header("Location: ../Mahasiswa/profil.php");
            exit;
        } else {
            $error = "Password atau NIM salah.";
        }
    } else {
        $error = "Password atau NIM salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

    <!-- Login Start -->
    <section class = "login">
        <div class = "login-form">
            <h2>Login</h2>
            <form name="login" method="post" autocomplete="off">
                
                <!-- Input Login -->
                <div class = "form-input username">
                    <input type="text" id="username" name="username" required>
                    <label for="username">NIM</label>
                    <span class="material-symbols-outlined">person</span>
                </div>

                <div class = "form-input password">
                    <input type="password" id="password" name="password" class="isi-password" required>
                    <label for="password">Password</label>
                    <span class="material-symbols-outlined togglePassword">lock</span>
                </div>

                <!-- Notif Error -->
                <?php if (!empty($error)) : ?>
                    <div style="color: red; font-size: 0.9em; margin-bottom: 10px; text-align: center;">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <button class="login-btn" type="submit">Login</button>
                <p>Don't have account ? <a href="register.php">Sign Up</a></p>
            </form>
        </div>

        <!-- Teks Welcome Back -->
        <div class="login-text">
            <h2>WELCOME</h2>
            <h2>BACK</h2>
        </div>
    </section>
    <!-- Login End -->

    <script src="../script.js"></script>
</body>
</html>