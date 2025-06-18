<?php
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

        <div class = "register-form">
            <h2>Sign Up</h2>
            <form name="register" target="_self" method="post" autocomplete="off" action="login.php">
                <!-- Input register -->
                <div class = "form-input username">
                    <input type="text" id="username" required>
                    <label for="username">NIM</label>
                    <span class="material-symbols-outlined">assignment_ind</span>
                </div>

                <div class = "form-input nama">
                    <input type="text" id="nama" required>
                    <label for="nama">Nama Lengkap</label>
                    <span class="material-symbols-outlined">person</span>
                </div>

                <div class = "form-input password">
                    <input type="password" id="password" class="isi-password" required>
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