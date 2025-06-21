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

// Filter
$where = "WHERE pd.status = 'Disetujui' AND pd.status_transfer = 'Sudah di-transfer'";

// Filter nama
if (!empty($_GET['cari'])) {
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $where .= " AND u.nama_lengkap LIKE '%$cari%'";
}

// Filter jenis bantuan
if (!empty($_GET['jenis'])) {
    $jenis = mysqli_real_escape_string($koneksi, $_GET['jenis']);
    $where .= " AND pd.jenis_pengajuan = '$jenis'";
}

// Filter angkatan
if (!empty($_GET['angkatan'])) {
    $angkatan = mysqli_real_escape_string($koneksi, $_GET['angkatan']);
    $where .= " AND m.angkatan = '$angkatan'";
}

// Ambil data history pengajuan
$history = [];
$query = "
    SELECT 
        pd.id,
        pd.jenis_pengajuan,
        pd.nominal,
        m.rekening,
        u.nama_lengkap,
        m.angkatan,
        m.id AS id_mahasiswa
    FROM pengajuan_dana pd
    JOIN mahasiswa m ON pd.id_mahasiswa = m.id
    JOIN users u ON m.nim = u.nim
    $where
    ORDER BY pd.id DESC
";

$result = mysqli_query($koneksi, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $history[] = $row;
    }
}

// Ringkasan total nominal per jenis pengajuan
$ringkasan = [];
$ringkasan_query = mysqli_query($koneksi, "
    SELECT pd.jenis_pengajuan, SUM(pd.nominal) AS total_dana
    FROM pengajuan_dana pd
    JOIN mahasiswa m ON pd.id_mahasiswa = m.id
    JOIN users u ON m.nim = u.nim
    $where
    GROUP BY pd.jenis_pengajuan
");
while ($r = mysqli_fetch_assoc($ringkasan_query)) {
    $ringkasan[$r['jenis_pengajuan']] = $r['total_dana'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SLMS - History</title>
    <link rel="stylesheet" href="../StyleA/admin.css">
    <style>
        form.filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        form.filter-form input,
        form.filter-form select,
        form.filter-form button {
            padding: 6px;
            font-size: 14px;
        }
        form.filter-form button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }
        form.filter-form button:hover {
            background-color: #2980b9;
        }
        .ringkasan {
            margin-bottom: 15px;
        }
        .ringkasan ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>
<body>

<?php include '../NavigasiA/navbarA.php'; ?>
<div class="container">
    <?php include '../NavigasiA/navmainA.php'; ?>
    <main class="main-content">
        <section class="history-section">
            <h2>History Pengajuan Dicairkan</h2>

            <!-- Form Filter -->
            <form method="GET" class="filter-form">
                <input type="text" name="cari" placeholder="Cari nama mahasiswa..." value="<?= $_GET['cari'] ?? '' ?>">

                <select name="jenis">
                    <option value="">Semua Jenis Bantuan</option>
                    <option value="Beasiswa" <?= ($_GET['jenis'] ?? '') == 'Beasiswa' ? 'selected' : '' ?>>Beasiswa</option>
                    <option value="UKT" <?= ($_GET['jenis'] ?? '') == 'UKT' ? 'selected' : '' ?>>UKT</option>
                </select>

                <select name="angkatan">
                    <option value="">Semua Angkatan</option>
                    <?php
                    $angkatan_query = mysqli_query($koneksi, "SELECT DISTINCT angkatan FROM mahasiswa ORDER BY angkatan DESC");
                    while ($a = mysqli_fetch_assoc($angkatan_query)) {
                        $selected = ($_GET['angkatan'] ?? '') == $a['angkatan'] ? 'selected' : '';
                        echo "<option value='{$a['angkatan']}' $selected>{$a['angkatan']}</option>";
                    }
                    ?>
                </select>

                <button type="submit">Filter</button>
            </form>

            <!-- Ringkasan Dana -->
            <?php if (!empty($ringkasan)): ?>
                <div class="ringkasan">
                    <h4>Ringkasan Bantuan Dicairkan:</h4>
                    <ul>
                        <?php foreach ($ringkasan as $jenis => $total): ?>
                            <li><strong><?= htmlspecialchars($jenis) ?></strong>: Rp <?= number_format($total, 0, ',', '.') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Tabel History -->
            <div class="history-table-wrapper">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Bantuan</th>
                            <th>Nominal</th>
                            <th>Nama Mahasiswa</th>
                            <th>Angkatan</th>
                            <th>No. Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($history) > 0): ?>
                            <?php foreach ($history as $i => $item): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($item['jenis_pengajuan']) ?></td>
                                    <td>Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="detail_mahasiswa.php?id=<?= $item['id_mahasiswa'] ?>">
                                            <?= htmlspecialchars($item['nama_lengkap']) ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($item['angkatan']) ?></td>
                                    <td><?= htmlspecialchars($item['rekening']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align:center;">Tidak ada data sesuai filter.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<script src="../Script/akses.js"></script>
</body>
</html>
