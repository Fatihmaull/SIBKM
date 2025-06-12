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
<?php include '../Navigasi/navbar.php'; ?>
<section class="container">
    <!-- Sidebar -->
    <?php include '../Navigasi/navmain.php'; ?>
    
    <!-- Page Berkas Start -->
    <form action="pengajuan.php" class="pageBerkas" method="post" autocomplete="off" enctype="multipart/form-data">
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
<script src="../Script/akses.js"></script>
</body>
</html>
