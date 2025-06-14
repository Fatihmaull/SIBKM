<?php
$mahasiswa = [
    ["id" => 1, "nama" => "Rizki Pratama", "nominal" => 5000000],
    ["id" => 2, "nama" => "Siti Nurhaliza", "nominal" => 2500000]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLMS Dashboard</title>
    <link rel="stylesheet" href="../Style/admin.css">
</head>

<body>
    <!-- Navbar -->
    <?php include '../Navigasi/navbar.php'; ?>

    <div class="container">
        <!-- Sidebar -->
        <?php include '../Navigasi/navmain.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <section class="verifikasi-section">
                <h2>Daftar Pengajuan</h2>
                <div class="verifikasi-table-wrapper">
                    <table class="verifikasi-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mahasiswa as $i => $m): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><a href="detail_mahasiswa.php?id=<?= $m['id'] ?>"><?= $m['nama'] ?></a></td>
                                    <td>Rp <?= number_format($m['nominal'], 0, ',', '.') ?></td>
                                    <td>
                                        <select class="status-dropdown">
                                            <option>Disetujui</option>
                                            <option>Ditolak</option>
                                            <option selected>Menunggu</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script src="../Script/akses.js"></script>
</body>

</html>