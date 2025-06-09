<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <!-- Style -->
    <link rel="stylesheet" href="../Style/mahasiswa.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>

</head>
<body>
    <!-- Navigasi Bar -->
    <?php include '../Navigasi/navbar.php'; ?>

    <section class="container">
        <!-- Navigasi Main -->
        <?php include '../Navigasi/navmain.php'; ?>

        <!-- Konten Profil Start-->
        <form class ="pageProfil" method="post" autocomplete="off" enctype="multipart/form-data">
            <button type="button" id="btn-edit">Ubah Biodata</button>
            <p>Data Diri</p>
            <!-- Form Data Diri -->
            <div class="formDataDiri">
                <div class="form-input foto">
                    <img id="foto" src="../Gambar/foto.jpg" alt="Foto Diri">
                    <label class="icon-camera" for="file-input"><span class="material-symbols-outlined">add_a_photo</span></label>
                    <input type="file" name="foto" id="file-input" accept="image/*" onchange="previewFoto(this)" style="display: none;">
                </div>
                
                <div class="inputProfile">
                    <div class="form-input nim">
                        <label for="nim">NIM</label> 
                        <input type="text" name="nim" value="1237050041" readonly required>
                    </div>
                    
                    <div class="form-input nama">
                        <label for="nama">Nama Lengkap</label> 
                        <input type="text" name="nama" value="Siapa Aja" readonly required>
                    </div>
                    
                    <div class="form-input jenisKelamin">
                        <label for="jenis">Jenis Kelamin</label>
                        <select id="jenisKelamin" name="jenis" disabled>
                            <option value="pilih">Pilih</option>
                            <option value="laki-laki">Laki - Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-input tanggalLahir">
                        <label for="tanggal">Tanggal Lahir</label> 
                        <input type="date" name="tanggal" value="2025-03-24" readonly required>
                    </div>

                    <div class="form-input whatsApp">
                        <label for="whatsApp">No WhatsApp</label>
                        <input type="text" name="whatsApp" value="089653278" readonly required>
                    </div>

                    <div class="form-input email">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="coba@gmail.com" readonly required>
                    </div>

                    <div class="form-input jurusan">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" name="jurusan" value="Teknik Informatika" readonly required>
                    </div>

                    <div class="form-input fakultas">
                        <label for="fakultas">Fakultas</label>
                        <input type="text" name="fakultas" value="Sains dan Teknologi" readonly required>
                    </div>

                    <div class="form-input angkatan">
                        <label for="angkatan">Angkatan</label>
                        <input type="text" name="angkatan" value="2023" readonly required>
                    </div>

                    <div class="form-input rekening">
                        <label for="rekening">Rekening</label>
                        <input type="text" name="rekening" value="098765" readonly required>
                    </div>
                </div>
            </div>

            <p>Data Akademik</p>
            <div class="formAkademik">
                <div class="form-input semester">
                    <label for="semester">Semester</label>
                    <input type="number" name="semester" value="1" readonly required>
                </div>

                <div class="form-input ips">
                    <label for="ips">IPS</label>
                    <input type="text" name="ips" value="4" readonly required>
                </div>

                <div class="form-input ipk">
                    <label for="ipk">IPK</label>
                    <input type="text" name="ipk" value="4" readonly required>
                </div>

                <div class="form-input dosen">
                    <label for="dosen">Dosen Pembimbing</label>
                    <input type="text" name="dosen" value="Fulan" readonly required>
                </div>
            </div>

            <p>Data Orang Tua</p>
            <div class="formOrangTua">
                <div class="form-input Namaayah">
                    <label for="ayah">Nama Ayah</label>
                    <input type="text" name="ayah" value="1" readonly required>
                </div>

                <div class="form-input pekerjaanAyah">
                    <label for="pekerjaanAyah">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaanAyah" value="4" readonly required>
                </div>
                
                <div class="form-input namaIbu">
                    <label for="ibu">Nama Ibu</label>
                    <input type="text" name="ibu" value="4" readonly required>
                </div>

                <div class="form-input pekerjaanIbu">
                    <label for="pekerjaanIbu">Pekerjaan Ibu </label>
                    <input type="text" name="pekerjaanIbu" value="Fulan" readonly required>
                </div>

                <div class="form-input pendapatan">
                        <label for="pendapatan">Pendapatan Orang Tua</label>
                        <input type="text" name="pendapatan" value="Fulan" readonly required>
                </div>
            </div>

            <!-- Button Save -->
            <button type="submit" id="btn-simpan">Simpan</button>
            <button type="button" id="btn-kembali">Kembali</button>
        </form>
        <!-- Konten Profil End-->
    </section>

    <script src="../Script/akses.js"></script>
</body>
</html>