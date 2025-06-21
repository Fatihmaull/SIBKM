<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sibkm";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$pengajuan = [];

// Ambil data pengajuan dan nama mahasiswa dari tabel users (melalui mahasiswa)
$query = "
    SELECT 
        pd.id,
        pd.id_mahasiswa,
        u.nama_lengkap,
        pd.nominal,
        pd.status
    FROM pengajuan_dana pd
    JOIN mahasiswa m ON pd.id_mahasiswa = m.id
    JOIN users u ON m.nim = u.nim
";

$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pengajuan[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLMS Dashboard</title>
    <link rel="stylesheet" href="../StyleA/admin.css">
</head>

<body>
    <!-- Navbar -->
    <?php include '../NavigasiA/navbarA.php'; ?>

    <div class="container">
        <!-- Sidebar -->
        <?php include '../NavigasiA/navmainA.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <section class="verifikasi-section">
                <h2>Daftar Pengajuan Bantuan</h2>
                <div class="verifikasi-table-wrapper">
                    <table class="verifikasi-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pengajuan)): ?>
                                <?php foreach ($pengajuan as $i => $p): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td>
                                            <a href="detail_mahasiswa.php?id=<?= $p['id_mahasiswa'] ?>">
                                                <?= htmlspecialchars($p['nama_lengkap']) ?>
                                            </a>
                                        </td>
                                        <td>Rp <?= number_format($p['nominal'], 0, ',', '.') ?></td>
                                        <td>
                                            <select class="status-dropdown" data-id="<?= $p['id'] ?>">
                                                <option value="Disetujui" <?= $p['status'] == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                                                <option value="Ditolak" <?= $p['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                                <option value="Menunggu" <?= $p['status'] == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;">Belum ada pengajuan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script src="../Script/akses.js"></script>

    <!-- Script AJAX untuk update status -->
    <script>
    document.querySelectorAll('.status-dropdown').forEach(select => {
        select.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const status = this.value;

            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}&status=${encodeURIComponent(status)}`
            })
            .then(res => res.text())
            .then(response => {
                if (response === 'OK') {
                    alert('Status berhasil diperbarui.');
                } else {
                    alert('Gagal memperbarui status.');
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan saat menghubungi server.');
                console.error(error);
            });
        });
    });
    </script>
</body>
</html>
