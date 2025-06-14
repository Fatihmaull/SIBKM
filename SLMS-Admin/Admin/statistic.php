<?php
$history = [
    ["jenis" => "Beasiswa", "nominal" => 5000000, "nama" => "Rizki Pratama", "rekening" => "1234567890"],
    ["jenis" => "UKT", "nominal" => 2500000, "nama" => "Siti Nurhaliza", "rekening" => "9876543210"]
];

$totalPengajuan = count($history);
$totalNominal = array_sum(array_column($history, 'nominal'));
$verified = 80;
$distributed = 25;
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
    <?php include '../Navigasi/navbar.php'; ?>
    <div class="container">
        <?php include '../Navigasi/navmain.php'; ?>
        <main class="main-content">
            <section class="content">
                <div class="card-container">
                    <div class="card"><h3><?= $totalPengajuan ?></h3><p>Pengajuan</p></div>
                    <div class="card"><h3><?= $verified ?></h3><p>Verified</p></div>
                    <div class="card"><h3><?= $distributed ?></h3><p>Distributed</p></div>
                    <div class="card"><h3>Rp <?= number_format($totalNominal, 0, ',', '.') ?></h3><p>Total Dana</p></div>
                </div>
            </section>
        </main>
    </div>
    <script src="../Script/akses.js"></script>
</body>
</html>
