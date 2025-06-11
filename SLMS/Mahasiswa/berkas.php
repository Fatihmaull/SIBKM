<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas Pengajuan</title>

    <!-- Style -->
    <link rel="stylesheet" href="../Style/mahasiswa.css">
</head>
<body>
    <!-- Navigasi Bar-->
    <?php include '../Navigasi/navbar.php'; ?>

    <section class="container">
        <!-- Navigasi Main -->
        <?php include '../Navigasi/navmain.php'; ?>

        <!-- Berkas Start -->
        <form action="" class ="pageBerkas" method="post" autocomplete="off" enctype="multipart/form-data">
            <h3>Berkas Wajib</h3>
            <div class="containerInputBerkas">
                <!-- Upload Berkas -->
                <div class="uploadBerkas">
                    <span class="material-symbols-outlined icon">id_card</span>
                    <h4>Kartu Tanda Mahasiswa <br>(KTM)</h4>
                    <input type="file" name="ktm" accept=".pdf" hidden>
                    <label for="ktm">
                        <span class="material-symbols-outlined upload">upload</span>Upload KTM
                    </label>
                    <p id="nama-file">Belum Ada File</p>
                </div>
                
                <div class="uploadBerkas">
                    <span class="material-symbols-outlined icon">description</span>
                    <h4>Surat Keterangan <br>Tidak Mampu (SKTM)</h4>
                    <input type="file" name="ktm" accept=".pdf" hidden>
                    <label for="ktm">
                        <span class="material-symbols-outlined upload">upload</span>Upload SKTM
                    </label>
                    <p id="nama-file">Belum Ada File</p>
                </div>
                
                <div class="uploadBerkas">
                    <span class="material-symbols-outlined icon">fact_check</span>
                    <h4>Kartu Rencana Studi<br>(KRS)</h4>
                    <input type="file" name="ktm" accept=".pdf" hidden>
                    <label for="ktm">
                        <span class="material-symbols-outlined upload">upload</span>Upload KRS
                    </label>
                    <p id="nama-file">Belum Ada File</p>
                </div>

                <div class="uploadBerkas">
                    <span class="material-symbols-outlined icon">receipt_long</span>
                    <h4>Bukti Pembayaran <br>UKT</h4>
                    <input type="file" name="ktm" accept=".pdf" hidden>
                    <label for="ktm">
                        <span class="material-symbols-outlined upload">upload</span>Upload Slip UKT
                    </label>
                    <p id="nama-file">Belum Ada File</p>
                </div>

                <div class="uploadBerkas">
                    <span class="material-symbols-outlined icon">payments</span>
                    <h4>Slip Gaji <br>Orang Tua</h4>
                    <input type="file" name="ktm" accept=".pdf" hidden>
                    <label for="ktm">
                        <span class="material-symbols-outlined upload">upload</span>Upload Slip Gaji
                    </label>
                    <p id="nama-file">Belum Ada File</p>
                </div>

                <div class="uploadBerkas">
                    <span class="material-symbols-outlined icon">house</span>
                    <h4>Foto<br>Rumah</h4>
                    <input type="file" name="ktm" accept=".pdf" hidden>
                    <label for="ktm">
                        <span class="material-symbols-outlined upload">upload</span>Upload Foto Rumah
                    </label>
                    <p id="nama-file">Belum Ada File</p>
                </div>

                <!-- Berkas Ceklis -->
                <ul class="ceklisItem">
                    <li>KTM<span class="material-symbols-outlined">check_box_outline_blank</span></li>
                    <li>SKTM<span class="material-symbols-outlined">check_box_outline_blank</span></li>
                    <li>KRS<span class="material-symbols-outlined">check_box_outline_blank</span></li>
                    <li>UKT<span class="material-symbols-outlined">check_box_outline_blank</span></li>
                    <li>Slip Gaji<span class="material-symbols-outlined">check_box_outline_blank</span></li>
                    <li>Foto Rumah<span class="material-symbols-outlined">check_box_outline_blank</span></li>
                    
                </ul>
            </div>
        </form>
        <!-- Berkas End -->
    </section>

    <!-- Scrip Js -->
    <script src="../Script/akses.js">
    </script>
</body>
</html>