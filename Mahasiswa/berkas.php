<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sibkm";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// redirect kalau belum login
if (!isset($_SESSION['id_mahasiswa'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id_mahasiswa'];

// ambil data lama dari database
$data_berkas = [];
$result = $conn->query("SELECT * FROM pengajuan_berkas WHERE id_mahasiswa = $id ORDER BY tanggal_upload DESC LIMIT 1");
if ($result && $result->num_rows > 0) {
    $data_berkas = $result->fetch_assoc();
}

// handle submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $folder = "../uploads/";
    $berkas = ['ktm', 'sktm', 'krs', 'ukt', 'gaji', 'rumah'];
    $path = [];

    foreach ($berkas as $b) {
        if (isset($_FILES[$b]) && $_FILES[$b]['error'] == 0) {
            // hapus file lama klo ada
            if (!empty($data_berkas[$b]) && file_exists($folder . $data_berkas[$b])) {
                unlink($folder . $data_berkas[$b]);
            }

            $nama = $_FILES[$b]['name'];
            $tmp = $_FILES[$b]['tmp_name'];
            $ekst = pathinfo($nama, PATHINFO_EXTENSION);
            $nama_baru = $b . "" . $id . "" . time() . "." . $ekst;
            move_uploaded_file($tmp, $folder . $nama_baru);
            $path[$b] = $nama_baru;
        } else {
            $path[$b] = $data_berkas[$b] ?? ''; // pakai file lama klo g upload baru
        }
    }

    // Simpen (update klo udh ada, insert klo belum)
    if (!empty($data_berkas)) {
        $stmt = $conn->prepare("UPDATE pengajuan_berkas SET ktm=?, sktm=?, krs=?, ukt=?, slip_gaji=?, foto_rumah=? WHERE id_mahasiswa=?");
        $stmt->bind_param("ssssssi", $path['ktm'], $path['sktm'], $path['krs'], $path['ukt'], $path['gaji'], $path['rumah'], $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO pengajuan_berkas (id_mahasiswa, ktm, sktm, krs, ukt, slip_gaji, foto_rumah) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $id, $path['ktm'], $path['sktm'], $path['krs'], $path['ukt'], $path['gaji'], $path['rumah']);
    }

    $stmt->execute();
    $sukses = true;

    // refresh data terbaru
    $result = $conn->query("SELECT * FROM pengajuan_berkas WHERE id_mahasiswa = $id ORDER BY tanggal_upload DESC LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $data_berkas = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas Pengajuan</title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="../Style/mahasiswa.css">
    <!-- Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>

<!-- Navigasi Bar -->
<?php include 'Navigasi/navbar.php'; ?>
<section class="container">
    <!-- Sidebar -->
    <?php include 'Navigasi/navmain.php'; ?>
    
    <!-- Page Berkas Start -->
    <form action="berkas.php" class="pageBerkas" method="post" autocomplete="off" enctype="multipart/form-data">

    <?php if (isset($sukses) && $sukses): ?>
        <p style="background:#d4edda;color:#155724;padding:10px;border-left:5px solid #28a745;margin-bottom:15px;">
            ✅ Berkas berhasil dikirim.
        </p>
    <?php elseif (isset($error)): ?>
        <p style="background:#f8d7da;color:#721c24;padding:10px;border-left:5px solid #dc3545;margin-bottom:15px;">
            ❌ Gagal upload berkas: <?= strtoupper($error); ?>
        </p>
    <?php endif; ?>

    <h3>Berkas Wajib</h3>
    <div class="containerInputBerkas">
        <!-- Upload KTM -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">id_card</span>
            <h4>Kartu Tanda Mahasiswa <br>(KTM)</h4>
            <label for="ktm"><span class="material-symbols-outlined upload">upload</span>Upload KTM</label>
            <input type="file" id="ktm" name="ktm" accept=".pdf, .png" hidden required>
            <p id="fileNameKTM">Belum Ada File (.pdf .png)</p>
        </div>

        <!-- Upload SKTM -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">description</span>
            <h4>Surat Keterangan <br>Tidak Mampu (SKTM)</h4>
            <label for="sktm"><span class="material-symbols-outlined upload">upload</span>Upload SKTM</label>
            <input type="file" id="sktm" name="sktm" accept=".pdf, .png" hidden required>
            <p id="fileNameSKTM">Belum Ada File (.pdf .png)</p>
        </div>

        <!-- Upload KRS -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">fact_check</span>
            <h4>Kartu Rencana Studi<br>(KRS)</h4>
            <label for="krs"><span class="material-symbols-outlined upload">upload</span>Upload KRS</label>
            <input type="file" id="krs" name="krs" accept=".pdf, .png" hidden required>
            <p id="fileNameKRS">Belum Ada File (.pdf .png)</p>
        </div>

        <!-- Upload UKT -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">receipt_long</span>
            <h4>Bukti Pembayaran <br>UKT</h4>
            <label for="ukt"><span class="material-symbols-outlined upload">upload</span>Upload Slip UKT</label>
            <input type="file" id="ukt" name="ukt" accept=".pdf, .png" hidden required>
            <p id="fileNameUKT">Belum Ada File (.pdf .png)</p>
        </div>

        <!-- Upload Slip Gaji -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">payments</span>
            <h4>Slip Gaji <br>Orang Tua</h4>
            <label for="gaji"><span class="material-symbols-outlined upload">upload</span>Upload Slip Gaji</label>
            <input type="file" id="gaji" name="gaji" accept=".pdf, .png" hidden required>
            <p id="fileNameGAJI">Belum Ada File (.pdf .png)</p>
        </div>

        <!-- Upload Foto Rumah -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">house</span>
            <h4>Foto<br>Rumah</h4>
            <label for="rumah"><span class="material-symbols-outlined upload">upload</span>Upload Foto Rumah</label>
            <input type="file" id="rumah" name="rumah" accept=".pdf, .png" hidden required>
            <p id="fileNameRUMAH">Belum Ada File (.pdf .png)</p>
        </div>

        <!-- Ceklis Berkas -->
        <ul class="ceklisItem">
            <li>KTM<span class="material-symbols-outlined" id="cekKTM">check_box_outline_blank</span></li>
            <li>SKTM<span class="material-symbols-outlined" id="cekSKTM">check_box_outline_blank</span></li>
            <li>KRS<span class="material-symbols-outlined" id="cekKRS">check_box_outline_blank</span></li>
            <li>UKT<span class="material-symbols-outlined" id="cekUKT">check_box_outline_blank</span></li>
            <li>Slip Gaji<span class="material-symbols-outlined" id="cekGAJI">check_box_outline_blank</span></li>
            <li>Foto Rumah<span class="material-symbols-outlined" id="cekRUMAH">check_box_outline_blank</span></li>
        </ul>

        <button type="submit" class="btn-submit">Submit Berkas</button>
    </div>
    </form>
</section>
<!-- Page Berkas End -->

<!-- Script -->
<script src="../script.js"></script>
</body>
</html>