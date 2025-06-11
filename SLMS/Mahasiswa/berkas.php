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
            <input type="file" id="ktm" name="ktm" accept=".pdf" hidden>
            <label for="ktm"><span class="material-symbols-outlined upload">upload</span>Upload KTM</label>
            <p id="fileNameKTM">Belum Ada File</p>
        </div>

        <!-- Upload SKTM -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">description</span>
            <h4>Surat Keterangan <br>Tidak Mampu (SKTM)</h4>
            <input type="file" id="sktm" name="sktm" accept=".pdf" hidden>
            <label for="sktm"><span class="material-symbols-outlined upload">upload</span>Upload SKTM</label>
            <p id="fileNameSKTM">Belum Ada File</p>
        </div>

        <!-- Upload KRS -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">fact_check</span>
            <h4>Kartu Rencana Studi<br>(KRS)</h4>
            <input type="file" id="krs" name="krs" accept=".pdf" hidden>
            <label for="krs"><span class="material-symbols-outlined upload">upload</span>Upload KRS</label>
            <p id="fileNameKRS">Belum Ada File</p>
        </div>

        <!-- Upload UKT -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">receipt_long</span>
            <h4>Bukti Pembayaran <br>UKT</h4>
            <input type="file" id="ukt" name="ukt" accept=".pdf" hidden>
            <label for="ukt"><span class="material-symbols-outlined upload">upload</span>Upload Slip UKT</label>
            <p id="fileNameUKT">Belum Ada File</p>
        </div>

        <!-- Upload Slip Gaji -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">payments</span>
            <h4>Slip Gaji <br>Orang Tua</h4>
            <input type="file" id="gaji" name="gaji" accept=".pdf" hidden>
            <label for="gaji"><span class="material-symbols-outlined upload">upload</span>Upload Slip Gaji</label>
            <p id="fileNameGaji">Belum Ada File</p>
        </div>

        <!-- Upload Foto Rumah -->
        <div class="uploadBerkas">
            <span class="material-symbols-outlined icon">house</span>
            <h4>Foto<br>Rumah</h4>
            <input type="file" id="rumah" name="rumah" accept=".pdf" hidden>
            <label for="rumah"><span class="material-symbols-outlined upload">upload</span>Upload Foto Rumah</label>
            <p id="fileNameRumah">Belum Ada File</p>
        </div>

        <!-- Ceklis Berkas -->
        <ul class="ceklisItem">
            <li>KTM<span class="material-symbols-outlined" id="cekKTM">check_box_outline_blank</span></li>
            <li>SKTM<span class="material-symbols-outlined" id="cekSKTM">check_box_outline_blank</span></li>
            <li>KRS<span class="material-symbols-outlined" id="cekKRS">check_box_outline_blank</span></li>
            <li>UKT<span class="material-symbols-outlined" id="cekUKT">check_box_outline_blank</span></li>
            <li>Slip Gaji<span class="material-symbols-outlined" id="cekGaji">check_box_outline_blank</span></li>
            <li>Foto Rumah<span class="material-symbols-outlined" id="cekRumah">check_box_outline_blank</span></li>
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
