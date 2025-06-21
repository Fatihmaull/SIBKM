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

$id = $_GET['id'] ?? 0;
$mahasiswa = null;
$berkas = [];

// Ambil data mahasiswa
$query_mhs = mysqli_query($koneksi, "
    SELECT m.*, u.nama_lengkap 
    FROM mahasiswa m 
    JOIN users u ON m.nim = u.nim 
    WHERE m.id = $id
");
if (mysqli_num_rows($query_mhs) === 1) {
    $mahasiswa = mysqli_fetch_assoc($query_mhs);
} else {
    die("Data mahasiswa tidak ditemukan.");
}

// Ambil data berkas
$query_berkas = mysqli_query($koneksi, "SELECT * FROM pengajuan_berkas WHERE id_mahasiswa = $id");
if (mysqli_num_rows($query_berkas) === 1) {
    $berkas_data = mysqli_fetch_assoc($query_berkas);
    $berkas = array_filter([
        $berkas_data['ktm'],
        $berkas_data['sktm'],
        $berkas_data['krs'],
        $berkas_data['slip_gaji'],
        $berkas_data['foto_rumah']
    ]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
  <link rel="stylesheet" href="../StyleA/admin.css">
</head>
<body>

<?php include '../NavigasiA/navbarA.php'; ?>
<div class="container">
  <?php include '../NavigasiA/navmainA.php'; ?>
  <main class="main-content">
    <section class="verifikasi-section">
      <h2>Detail Mahasiswa: <?= htmlspecialchars($mahasiswa['nama_lengkap']) ?></h2>

      <div class="detail-grid">
        <!-- Kolom Kiri: Data Diri -->
        <table class="data-table">
          <tr><td>NIM</td><td><?= htmlspecialchars($mahasiswa['nim']) ?></td></tr>
          <tr><td>Jurusan</td><td><?= htmlspecialchars($mahasiswa['jurusan']) ?></td></tr>
          <tr><td>Fakultas</td><td><?= htmlspecialchars($mahasiswa['fakultas']) ?></td></tr>
          <tr><td>Jenis Kelamin</td><td><?= htmlspecialchars($mahasiswa['jenis_kelamin']) ?></td></tr>
          <tr><td>Tanggal Lahir</td><td><?= htmlspecialchars($mahasiswa['tanggal_lahir']) ?></td></tr>
          <tr><td>WhatsApp</td><td><?= htmlspecialchars($mahasiswa['whatsapp']) ?></td></tr>
          <tr><td>Email</td><td><?= htmlspecialchars($mahasiswa['email']) ?></td></tr>
          <tr><td>Angkatan</td><td><?= htmlspecialchars($mahasiswa['angkatan']) ?></td></tr>
          <tr><td>Rekening</td><td><?= htmlspecialchars($mahasiswa['rekening']) ?></td></tr>
          <tr><td>Semester</td><td><?= htmlspecialchars($mahasiswa['semester']) ?></td></tr>
          <tr><td>IPS</td><td><?= htmlspecialchars($mahasiswa['ips']) ?></td></tr>
          <tr><td>IPK</td><td><?= htmlspecialchars($mahasiswa['ipk']) ?></td></tr>
          <tr><td>Dosen Pembimbing</td><td><?= htmlspecialchars($mahasiswa['dosen_pembimbing']) ?></td></tr>
          <tr><td>Nama Ayah</td><td><?= htmlspecialchars($mahasiswa['nama_ayah']) ?></td></tr>
          <tr><td>Pekerjaan Ayah</td><td><?= htmlspecialchars($mahasiswa['pekerjaan_ayah']) ?></td></tr>
          <tr><td>Nama Ibu</td><td><?= htmlspecialchars($mahasiswa['nama_ibu']) ?></td></tr>
          <tr><td>Pekerjaan Ibu</td><td><?= htmlspecialchars($mahasiswa['pekerjaan_ibu']) ?></td></tr>
          <tr><td>Pendapatan Orang Tua</td><td><?= htmlspecialchars($mahasiswa['pendapatan_orangtua']) ?></td></tr>
        </table>

        <!-- Kolom Kanan: Daftar Berkas -->
        <div class="berkas-list">
          <h4>Daftar Berkas</h4>
          <ul>
            <?php foreach ($berkas as $file): ?>
              <li>
                <a href="../Uploads/Mahasiswa/<?= $id ?>/<?= $file ?>" target="_blank">
                  <?= htmlspecialchars($file) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>
  </main>
</div>

<!-- Modal Password Admin -->
<div class="modal" id="passwordModal">
  <div class="modal-content">
    <p>Masukkan password admin:</p>
    <input type="password" id="adminPass" placeholder="Password">
    <button onclick="verifyPassword()">Verifikasi</button>
  </div>
</div>

<script>
function verifyPassword() {
  const input = document.getElementById("adminPass").value;
  if (input === "admin123") {
    alert("Password benar. Status diizinkan untuk diubah.");
    document.getElementById("passwordModal").style.display = "none";
  } else {
    alert("Password salah!");
  }
}
function showPasswordPrompt() {
  document.getElementById("passwordModal").style.display = "flex";
}
</script>

<script src="../Script/akses.js"></script>
</body>
</html>
