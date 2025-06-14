<?php
$dataDistribusi = [
    ["nama" => "Rizki Pratama", "rekening" => "1234567890", "status" => "Disetujui"],
    ["nama" => "Siti Nurhaliza", "rekening" => "9876543210", "status" => "Menunggu"]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribusi Dana</title>
    <link rel="stylesheet" href="../Style/admin.css">
</head>
<body>
    <?php include '../Navigasi/navbar.php'; ?>
    <div class="container">
        <?php include '../Navigasi/navmain.php'; ?>
        <main class="main-content">
            <section class="history-section">
                <h2>Distribusi Dana</h2>
                <div class="history-table-wrapper">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>No. Rekening</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dataDistribusi as $i => $d): ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td><?= $d['nama'] ?></td>
                                <td><?= $d['rekening'] ?></td>
                                <td><?= $d['status'] ?></td>
                                <td>
                                    <select class="status-dropdown">
                                        <option selected>Belum Ditransfer</option>
                                        <option>Sudah Ditransfer</option>
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
