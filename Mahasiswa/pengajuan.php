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

if (!isset($_SESSION['id_mahasiswa'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id_mahasiswa'];

$data_berkas = [];
$result = $conn->query("SELECT * FROM pengajuan_berkas WHERE id_mahasiswa = $id ORDER BY tanggal_upload DESC LIMIT 1");
if ($result && $result->num_rows > 0) {
    $data_berkas = $result->fetch_assoc();
}

$rekening = "";
$result = $conn->query("SELECT no_rekening FROM pengajuan_dana WHERE id_mahasiswa = $id");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $rekening = $row['no_rekening'] ?? "";
}

// Handle submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST['jenisPengajuan'];
    $nominal = $_POST['nominal'];

    if ($jenis !== 'Pilih' && !empty($nominal)) {
        $stmt = $conn->prepare("INSERT INTO pengajuan_dana (id_mahasiswa, jenis_pengajuan, nominal, no_rekening, tanggal_pengajuan) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("isss", $id, $jenis, $nominal, $rekening);
        $stmt->execute();

        header("Location: riwayat.php?status=sukses");
        exit;
    }
}
?>

<?php
function cekIkonHTML($field, $data_berkas) {
    $isUploaded = !empty($data_berkas[$field]);
    $icon = $isUploaded ? 'check_box' : 'check_box_outline_blank';
    $class = $isUploaded ? 'checked' : '';
    return "<span class='material-symbols-outlined $class' id='cek" . strtoupper($field) . "'>$icon</span>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan</title>
    <link rel="stylesheet" href="../Style/mahasiswa.css">
</head>
<body>
    <!-- Navigasi Bar-->
    <?php include 'Navigasi/navbar.php'; ?>

    <section class="container">
        <!-- Navigasi Main -->
        <?php include 'Navigasi/navmain.php'; ?>

        <!-- Pengajuan Start -->
        <form action="pengajuan.php" class="pagePengajuan" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="containerPengajuan">
                <ul class="ceklis-item">
                    <li>KTM<?= cekIkonHTML('ktm', $data_berkas); ?></li>
                    <li>SKTM<?= cekIkonHTML('sktm', $data_berkas); ?></li>
                    <li>KRS<?= cekIkonHTML('krs', $data_berkas); ?></li>
                    <li>UKT<?= cekIkonHTML('ukt', $data_berkas); ?></li>
                    <li>Slip Gaji<?= cekIkonHTML('slip_gaji', $data_berkas); ?></li>
                    <li>Foto Rumah<?= cekIkonHTML('foto_rumah', $data_berkas); ?></li>
                </ul>

                <div class="inputPengajuan">
                    <label for="jenisPengajuan">Jenis Pengajuan</label><br>
                    <select id="jenisPengajuan" name="jenisPengajuan">
                        <option>Pilih</option>
                        <option>Pembayaran UKT</option>
                        <option>Pembelian Buku</option>
                        <option>Bekal Jajan</option>
                    </select>
                </div>

                <div class="inputPengajuan">
                    <label for="nominal">Nominal</label><br>
                    <input type="text" id="nominal" name="nominal" placeholder="Masukan Nominal" required>
                </div>

                <div class="inputPengajuan">
                    <label for="rekening">No Rekening</label><br>
                    <input type="text" id="rekening" name="rekening" value="<?= $rekening ?>" required>
                </div>

                <button class="btn-submit">Submit Pengajuan</button>
            </div>
        </form>
        <!-- Pengajuan End -->
    </section>

    <script src="../script.js"></script>
</body>
</html>