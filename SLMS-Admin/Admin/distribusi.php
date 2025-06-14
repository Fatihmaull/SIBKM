<?php
// Simulasi data verifikasi
$verifikasi = [
  ["nama" => "Rizki Pratama", "rekening" => "1234567890", "status" => "Disetujui"],
  ["nama" => "Siti Nurhaliza", "rekening" => "9876543210", "status" => "Menunggu"]
];

// Ambil hanya yang statusnya Disetujui
$data = array_filter($verifikasi, function($row) {
  return $row['status'] === 'Disetujui';
});
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribusi Dana</title>
  <link rel="stylesheet" href="../Style/admin.css">
  <style>
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.3);
      text-align: center;
      max-width: 300px;
    }
    .modal-content input[type="password"] {
      padding: 8px;
      width: 100%;
      margin-bottom: 10px;
    }
    .modal-content button {
      padding: 6px 12px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
<?php include '../Navigasi/navbar.php'; ?>
<div class="container">
  <?php include '../Navigasi/navmain.php'; ?>
  <main class="main-content">
    <section class="verifikasi-section">
      <h2>Distribusi Dana</h2>
      <div class="verifikasi-table-wrapper">
        <table class="verifikasi-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No. Rekening</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($data as $row): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['rekening'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                  <select class="status-dropdown" onchange="handleDropdownChange(this)">
                    <option>Belum di-transfer</option>
                    <option>Sudah di-transfer</option>
                  </select>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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
let selectedDropdown = null;

function handleDropdownChange(element) {
  selectedDropdown = element;
  document.getElementById("passwordModal").style.display = "flex";
}

function verifyPassword() {
  const input = document.getElementById("adminPass").value;
  if (input === "admin123") {
    alert("Password benar. Status diperbarui.");
    document.getElementById("passwordModal").style.display = "none";
    document.getElementById("adminPass").value = "";
    // simpan ke DB di sini
  } else {
    alert("Password salah! Status tidak berubah.");
    document.getElementById("passwordModal").style.display = "none";
    document.getElementById("adminPass").value = "";
    if (selectedDropdown) selectedDropdown.value = "Belum di-transfer";
  }
}
</script>
<script src="../Script/akses.js"></script>
</body>
</html>
