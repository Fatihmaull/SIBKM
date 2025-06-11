<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan</title>

    <!-- Style -->
    <link rel="stylesheet" href="../Style/mahasiswa.css">
</head>
<body>
    <!-- Navigasi Bar-->
    <?php include '../Navigasi/navbar.php'; ?>

    <section class="container">
        <!-- Navigasi Main -->
        <?php include '../Navigasi/navmain.php'; ?>

        <!-- Pengajuan Start -->
        <form action="" class="pagePengajuan" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="containerPengajuan">
                <ul class="ceklis-item">
                    <li>KTM<span class="material-symbols-outlined" id="cekKTM">check_box_outline_blank</span></li>
                    <li>SKTM<span class="material-symbols-outlined" id="cekSKTM">check_box_outline_blank</span></li>
                    <li>KRS<span class="material-symbols-outlined" id="cekKRS">check_box_outline_blank</span></li>
                    <li>UKT<span class="material-symbols-outlined" id="cekUKT">check_box_outline_blank</span></li>
                    <li>Slip Gaji<span class="material-symbols-outlined" id="cekGaji">check_box_outline_blank</span></li>
                    <li>Foto Rumah<span class="material-symbols-outlined" id="cekRumah">check_box_outline_blank</span></li>
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
                <input type="text" id="nominal" placeholder="Masukan Nominal" required>
            </div>

            <div class="inputPengajuan">
                <label for="rekening">No Rekening</label><br>
                <input type="text" id="rekening" placeholder="Masukan No Rekening" required>
            </div>

            <button class="btn-submit">Submit Pengajuan</button>
            </div>
        </form>
        <!-- Pengajuan End -->
    </section>

    <!-- Scrip Js -->
    <script src="../Script/akses.js"></script>
</body>
</html>