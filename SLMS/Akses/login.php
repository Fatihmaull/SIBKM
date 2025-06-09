<?php
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
            <form name="login" target="_self" method="post" autocomplete="off" action="../Mahasiswa/profil.php">
                <!-- Input Login -->
                <div class = "form-input username">
                    <input type="text" id="username" required>
                    <label for="username">Username</label>
                    <span class="material-symbols-outlined">person</span>
                </div>

                <div class = "form-input password">
                    <input type="password" id="password" class="isi-password" required>
                    <label for="password">Password</label>
                    <span class="material-symbols-outlined togglePassword">lock</span>
                </div>

                <button class="login-btn" type="submit">Login</button>
                <p>Don't have account ? <a href="register.php">Sign Up</a> </p>
            </form>
        </div>

        <!-- Teks Welcome Back -->
        <div class="login-text">
            <h2>WELCOME</h2>
            <h2>BACK</h2>
        </div>
    </section>
    <!-- Login End -->

    <script src="../Script/akses.js"></script>
</body>
</html>