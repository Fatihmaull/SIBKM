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

$pesan = '';

// Proses perubahan status transfer jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verifikasi'])) {
    $id = $_POST['id_pengajuan'];
    $status_transfer = $_POST['status_transfer'];
    $password_input = $_POST['admin_password'];

    // Password admin langsung di-hardcode di sini (bisa kamu hash juga jika ingin)
    $password_admin = "admin123";

    if ($password_input === $password_admin) {
        $stmt = mysqli_prepare($koneksi, "UPDATE pengajuan_dana SET status_transfer = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $status_transfer, $id);

        if (mysqli_stmt_execute($stmt)) {
            $pesan = "✅ Status berhasil diperbarui.";
        } else {
            $pesan = "❌ Gagal memperbarui status.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $pesan = "⚠️ Password admin salah!";
    }
}

// Ambil data pengajuan yang disetujui
$data = [];
$query = "
    SELECT 
        pd.id,
        u.nama_lengkap,
        m.rekening,
        pd.status,
        pd.status_transfer
    FROM pengajuan_dana pd
    JOIN mahasiswa m ON pd.id_mahasiswa = m.id
    JOIN users u ON m.nim = u.nim
    WHERE pd.status = 'Disetujui'
";

$result = mysqli_query($koneksi, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Distribusi Dana</title>
  <link rel="stylesheet" href="../StyleA/admin.css">
  <style>
    .verifikasi-form {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .pesan {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f0f0f0;
        border-left: 4px solid #3498db;
    }
  </style>
</head>
<body>

<?php include '../NavigasiA/navbarA.php'; ?>
<div class="container">
  <?php include '../NavigasiA/navmainA.php'; ?>
  <main class="main-content">
    <section class="verifikasi-section">
      <h2>Distribusi Dana</h2>

      <?php if ($pesan): ?>
        <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
      <?php endif; ?>

      <div class="verifikasi-table-wrapper">
        <table class="verifikasi-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No. Rekening</th>
              <th>Status Pengajuan</th>
              <th>Status Transfer</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($data as $row): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['rekening']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td><?= htmlspecialchars($row['status_transfer']) ?></td>
                <td>
                  <form method="POST" class="verifikasi-form">
                    <input type="hidden" name="id_pengajuan" value="<?= $row['id'] ?>">
                    <select name="status_transfer" required>
                      <option value="Belum di-transfer" <?= $row['status_transfer'] == 'Belum di-transfer' ? 'selected' : '' ?>>Belum di-transfer</option>
                      <option value="Sudah di-transfer" <?= $row['status_transfer'] == 'Sudah di-transfer' ? 'selected' : '' ?>>Sudah di-transfer</option>
                    </select>
                    <input type="password" name="admin_password" placeholder="Password admin" required>
                    <button type="submit" name="verifikasi">Verifikasi</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>
<script src="../Script/akses.js"></script>
</body>
</html>
