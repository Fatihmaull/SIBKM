<?php
// Simulasi data detail mahasiswa (bisa diganti dengan ambil dari DB)
$id = $_GET['id'] ?? 1;

$mahasiswa = [
  1 => [
    "nama" => "Rizki Pratama",
    "nim" => "123456",
    "prodi" => "Teknik Informatika",
    "fakultas" => "Teknik",
    "jenis_kelamin" => "Laki-laki",
    "tanggal_lahir" => "2003-05-20",
    "whatsapp" => "081234567890",
    "email" => "rizki@mail.com",
    "jurusan" => "Teknik Informatika",
    "angkatan" => "2021",
    "rekening" => "1234567890",
    "semester" => 6,
    "ips" => 3.5,
    "ipk" => 3.6,
    "dosen" => "Dr. Andi",
    "ayah" => "Pak Budi",
    "ibu" => "Bu Sari",
    "pekerjaan_ayah" => "Petani",
    "pekerjaan_ibu" => "Ibu Rumah Tangga",
    "pendapatan" => "1.500.000"
  ]
];

$berkas = ["KTM.pdf", "SKTM.pdf", "KRS.pdf", "Slip Gaji.pdf", "Foto Rumah.jpg"];
$urutan = 1;
$detail = $mahasiswa[$id];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
  <link rel="stylesheet" href="../Style/admin.css">
</head>
<body>
<?php include '../Navigasi/navbar.php'; ?>
<div class="container">
  <?php include '../Navigasi/navmain.php'; ?>
  <main class="main-content">
    <section class="verifikasi-section">
      <h2><?= $urutan ?>. <?= $detail['nama'] ?></h2>

      <div class="detail-grid">
        <!-- Kolom Kiri: Data Diri -->
        <table class="data-table">
          <tr><td>NIM</td><td><?= $detail['nim'] ?></td></tr>
          <tr><td>Prodi</td><td><?= $detail['prodi'] ?></td></tr>
          <tr><td>Fakultas</td><td><?= $detail['fakultas'] ?></td></tr>
          <tr><td>Jenis Kelamin</td><td><?= $detail['jenis_kelamin'] ?></td></tr>
          <tr><td>Tanggal Lahir</td><td><?= $detail['tanggal_lahir'] ?></td></tr>
          <tr><td>WhatsApp</td><td><?= $detail['whatsapp'] ?></td></tr>
          <tr><td>Email</td><td><?= $detail['email'] ?></td></tr>
          <tr><td>Angkatan</td><td><?= $detail['angkatan'] ?></td></tr>
          <tr><td>Rekening</td><td><?= $detail['rekening'] ?></td></tr>
          <tr><td>Semester</td><td><?= $detail['semester'] ?></td></tr>
          <tr><td>IPS</td><td><?= $detail['ips'] ?></td></tr>
          <tr><td>IPK</td><td><?= $detail['ipk'] ?></td></tr>
          <tr><td>Dosen Pembimbing</td><td><?= $detail['dosen'] ?></td></tr>
          <tr><td>Nama Ayah</td><td><?= $detail['ayah'] ?></td></tr>
          <tr><td>Pekerjaan Ayah</td><td><?= $detail['pekerjaan_ayah'] ?></td></tr>
          <tr><td>Nama Ibu</td><td><?= $detail['ibu'] ?></td></tr>
          <tr><td>Pekerjaan Ibu</td><td><?= $detail['pekerjaan_ibu'] ?></td></tr>
          <tr><td>Pendapatan Orang Tua</td><td><?= $detail['pendapatan'] ?></td></tr>
        </table>

        <!-- Kolom Kanan: Daftar Berkas -->
        <div class="berkas-list">
          <h4>Daftar Berkas</h4>
          <ul>
            <?php foreach($berkas as $file): ?>
              <li>
                <a href="../Uploads/Mahasiswa/<?= $id ?>/<?= $file ?>" target="_blank">
                  <?= $file ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>
  </main>
</div>
<script src="../Script/akses.js"></script>
</body>
</html>
