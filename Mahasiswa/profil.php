<?php
session_start();

if (!isset($_SESSION['nim'])) {
    header("Location: ../Akses/login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_sibkm";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nim = $_SESSION['nim'];

$query_user = "SELECT nama_lengkap FROM users WHERE nim = ?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("s", $nim);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$data_user = $result_user->fetch_assoc();
$nama_lengkap = $data_user['nama_lengkap'];
$stmt_user->close();

// nyimpen k e databse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST['jenis'];
    $tanggal = $_POST['tanggal'];
    $whatsapp = $_POST['whatsApp'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $angkatan = $_POST['angkatan'];
    $rekening = $_POST['rekening'];
    $semester = $_POST['semester'];
    $ips = $_POST['ips'];
    $ipk = $_POST['ipk'];
    $dosen = $_POST['dosen'];
    $ayah = $_POST['ayah'];
    $pekerjaanAyah = $_POST['pekerjaanAyah'];
    $ibu = $_POST['ibu'];
    $pekerjaanIbu = $_POST['pekerjaanIbu'];
    $pendapatan = $_POST['pendapatan'];

    // Upload Foto
$foto = $data['foto'] ?? ''; // default 
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // nama file unik
    $ekstensi = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $nama_baru = $nim . "_" . time() . "." . $ekstensi;
    $target_dir = "../Uploads/";
    $target_file = $target_dir . $nama_baru;

    // Hapus foto lamakalo ganti
    if (!empty($foto) && file_exists($target_dir . $foto) && $foto != "foto.jpg") {
        unlink($target_dir . $foto);
    }

    // Upload foto baru
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto = $nama_baru; // update nama file baru ke database
    }
}

    // Cek data ada
    $cek = $conn->prepare("SELECT nim FROM mahasiswa WHERE nim = ?");
    $cek->bind_param("s", $nim);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        // Update
        $query = "UPDATE mahasiswa SET 
            jenis_kelamin=?, tanggal_lahir=?, whatsapp=?, email=?, jurusan=?, fakultas=?,
            angkatan=?, rekening=?, semester=?, ips=?, ipk=?, dosen_pembimbing=?,
            nama_ayah=?, pekerjaan_ayah=?, nama_ibu=?, pekerjaan_ibu=?, pendapatan_orangtua=?, foto=?
            WHERE nim=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssiddssssssss", 
            $jenis, $tanggal, $whatsapp, $email, $jurusan, $fakultas, $angkatan, $rekening,
            $semester, $ips, $ipk, $dosen, $ayah, $pekerjaanAyah, $ibu, $pekerjaanIbu, $pendapatan, $foto, $nim);
    } else {
        // Insert
        $query = "INSERT INTO mahasiswa (
            nim, jenis_kelamin, tanggal_lahir, whatsapp, email, jurusan, fakultas,
            angkatan, rekening, semester, ips, ipk, dosen_pembimbing,
            nama_ayah, pekerjaan_ayah, nama_ibu, pekerjaan_ibu, pendapatan_orangtua, foto
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssiddssssssss", 
            $nim, $jenis, $tanggal, $whatsapp, $email, $jurusan, $fakultas, $angkatan, $rekening,
            $semester, $ips, $ipk, $dosen, $ayah, $pekerjaanAyah, $ibu, $pekerjaanIbu, $pendapatan, $foto);
    }

    $stmt->execute();
    $stmt->close();
    header("Location: profil.php");
    exit;
}

// Ambil data biodata klo ada
$query_data = "SELECT * FROM mahasiswa WHERE nim = ?";
$stmt_data = $conn->prepare($query_data);
$stmt_data->bind_param("s", $nim);
$stmt_data->execute();
$result_data = $stmt_data->get_result();
$data = $result_data->fetch_assoc();
$stmt_data->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="../Style/mahasiswa.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
</head>
<body>
    <?php include 'Navigasi/navbar.php'; ?>

    <section class="container">
        <?php include 'Navigasi/navmain.php'; ?>

        <form class="pageProfil" method="post" autocomplete="off" enctype="multipart/form-data">
            <button type="button" id="btn-edit">Ubah Biodata</button>
            <p>Data Diri</p>
            <div class="formDataDiri">
                <div class="form-input foto">
                    <img id="foto" src="<?= isset($data['foto']) && $data['foto'] ? '../Uploads/' . htmlspecialchars($data['foto']) : '../Gambar/foto.jpg' ?>" alt="Foto Diri">
                    <label class="icon-camera" for="file-input"><span class="material-symbols-outlined">add_a_photo</span></label>
                    <input type="file" name="foto" id="file-input" accept="image/*" onchange="lihatFoto(this)" style="display: none;">
                </div>

                <div class="inputProfile">
                    <div class="form-input nim">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" value="<?= htmlspecialchars($nim) ?>" readonly required>
                    </div>

                    <div class="form-input nama">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" value="<?= htmlspecialchars($nama_lengkap) ?>" readonly required>
                    </div>

                    <div class="form-input jenisKelamin">
                        <label for="jenis">Jenis Kelamin</label>
                        <select id="jenisKelamin" name="jenis" disabled>
                            <option value="pilih">Pilih</option>
                            <option value="laki-laki" <?= isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'laki-laki' ? 'selected' : '' ?>>Laki - Laki</option>
                            <option value="perempuan" <?= isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-input tanggalLahir">
                        <label for="tanggal">Tanggal Lahir</label>
                        <input type="date" name="tanggal" value="<?= $data['tanggal_lahir'] ?? '' ?>" readonly required>
                    </div>

                    <div class="form-input whatsApp">
                        <label for="whatsApp">No WhatsApp</label>
                        <input type="text" name="whatsApp" value="<?= $data['whatsapp'] ?? '' ?>" readonly required>
                    </div>

                    <div class="form-input email">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?= $data['email'] ?? '' ?>" readonly required>
                    </div>

                    <div class="form-input jurusan">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" name="jurusan" value="<?= $data['jurusan'] ?? '' ?>" readonly required>
                    </div>

                    <div class="form-input fakultas">
                        <label for="fakultas">Fakultas</label>
                        <input type="text" name="fakultas" value="<?= $data['fakultas'] ?? '' ?>" readonly required>
                    </div>

                    <div class="form-input angkatan">
                        <label for="angkatan">Angkatan</label>
                        <input type="text" name="angkatan" value="<?= $data['angkatan'] ?? '' ?>" readonly required>
                    </div>

                    <div class="form-input rekening">
                        <label for="rekening">Rekening</label>
                        <input type="text" name="rekening" value="<?= $data['rekening'] ?? '' ?>" readonly required>
                    </div>
                </div>
            </div>

            <p>Data Akademik</p>
            <div class="formAkademik">
                <div class="form-input semester">
                    <label for="semester">Semester</label>
                    <input type="number" name="semester" value="<?= $data['semester'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input ips">
                    <label for="ips">IPS</label>
                    <input type="text" name="ips" value="<?= $data['ips'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input ipk">
                    <label for="ipk">IPK</label>
                    <input type="text" name="ipk" value="<?= $data['ipk'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input dosen">
                    <label for="dosen">Dosen Pembimbing</label>
                    <input type="text" name="dosen" value="<?= $data['dosen_pembimbing'] ?? '' ?>" readonly required>
                </div>
            </div>

            <p>Data Orang Tua</p>
            <div class="formOrangTua">
                <div class="form-input Namaayah">
                    <label for="ayah">Nama Ayah</label>
                    <input type="text" name="ayah" value="<?= $data['nama_ayah'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input pekerjaanAyah">
                    <label for="pekerjaanAyah">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaanAyah" value="<?= $data['pekerjaan_ayah'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input namaIbu">
                    <label for="ibu">Nama Ibu</label>
                    <input type="text" name="ibu" value="<?= $data['nama_ibu'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input pekerjaanIbu">
                    <label for="pekerjaanIbu">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaanIbu" value="<?= $data['pekerjaan_ibu'] ?? '' ?>" readonly required>
                </div>

                <div class="form-input pendapatan">
                    <label for="pendapatan">Pendapatan Orang Tua</label>
                    <input type="text" name="pendapatan" value="<?= $data['pendapatan_orangtua'] ?? '' ?>" readonly required>
                </div>
            </div>

            <button type="submit" id="btn-simpan">Simpan</button>
            <button type="button" id="btn-kembali">Kembali</button>
        </form>
    </section>

    <script src="../script.js"></script>
</body>
</html>