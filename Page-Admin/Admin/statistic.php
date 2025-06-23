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

// Statistik utama
$result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengajuan_dana");
$totalPengajuan = mysqli_fetch_assoc($result)['total'] ?? 0;

$result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengajuan_dana WHERE status = 'Disetujui'");
$verified = mysqli_fetch_assoc($result)['total'] ?? 0;

$result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengajuan_dana WHERE status_transfer = 'Sudah di-transfer'");
$distributed = mysqli_fetch_assoc($result)['total'] ?? 0;

$result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengajuan_dana WHERE status = 'Disetujui' AND (status_transfer != 'Sudah di-transfer' OR status_transfer IS NULL)");
$belumDistribusi = mysqli_fetch_assoc($result)['total'] ?? 0;

$result = mysqli_query($koneksi, "SELECT SUM(nominal) as total FROM pengajuan_dana");
$totalNominal = mysqli_fetch_assoc($result)['total'] ?? 0;

$result = mysqli_query($koneksi, "SELECT SUM(nominal) as total FROM pengajuan_dana WHERE status_transfer = 'Sudah di-transfer'");
$danaDidistribusikan = mysqli_fetch_assoc($result)['total'] ?? 0;

$result = mysqli_query($koneksi, "SELECT SUM(nominal) as total FROM pengajuan_dana WHERE status IN ('Menunggu', 'Ditolak')");
$danaProses = mysqli_fetch_assoc($result)['total'] ?? 0;

// Ekspor ke Excel
if (isset($_GET['export']) && $_GET['export'] === 'yes') {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=statistik_pengajuan.xls");
    echo "Kategori\tJumlah\n";
    echo "Total Pengajuan\t$totalPengajuan\n";
    echo "Disetujui\t$verified\n";
    echo "Sudah Didistribusikan\t$distributed\n";
    echo "Belum Didistribusikan\t$belumDistribusi\n";
    echo "Total Dana Pengajuan\tRp " . number_format($totalNominal, 0, ',', '.') . "\n";
    echo "Dana Sudah Didistribusikan\tRp " . number_format($danaDidistribusikan, 0, ',', '.') . "\n";
    echo "Dana Masih Diproses\tRp " . number_format($danaProses, 0, ',', '.') . "\n";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SLMS Dashboard</title>
    <link rel="stylesheet" href="../StyleA/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 100%;
            max-width: 700px;
            margin: 30px auto;
        }
        .export-button {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            margin: 15px 0;
            cursor: pointer;
        }
        .export-button:hover {
            background-color: #27ae60;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-start;
        }
        .card {
            background: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
            min-width: 180px;
            flex: 1;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        .card p {
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<?php include '../NavigasiA/navbarA.php'; ?>
<div class="container">
    <?php include '../NavigasiA/navmainA.php'; ?>
    <main class="main-content">
        <section class="content">
            <h2>Statistik Pengajuan Dana</h2>
            <div class="card-container">
                <div class="card"><h3><?= $totalPengajuan ?></h3><p>Total Pengajuan</p></div>
                <div class="card"><h3><?= $verified ?></h3><p>Disetujui</p></div>
                <div class="card"><h3><?= $distributed ?></h3><p>Sudah Didistribusikan</p></div>
                <div class="card"><h3><?= $belumDistribusi ?></h3><p>Belum Didistribusikan</p></div>
                <div class="card"><h3>Rp <?= number_format($totalNominal, 0, ',', '.') ?></h3><p>Total Dana Pengajuan</p></div>
                <div class="card"><h3>Rp <?= number_format($danaDidistribusikan, 0, ',', '.') ?></h3><p>Dana Sudah Didistribusikan</p></div>
                <div class="card"><h3>Rp <?= number_format($danaProses, 0, ',', '.') ?></h3><p>Dana Masih Diproses</p></div>
            </div>

            <!-- Tombol Ekspor -->
            <form method="get">
                <input type="hidden" name="export" value="yes">
                <button type="submit" class="export-button">📥 Ekspor ke Excel</button>
            </form>

            <!-- Grafik -->
            <div class="chart-container">
                <canvas id="chartStatistik"></canvas>
            </div>
        </section>
    </main>
</div>

<script>
const ctx = document.getElementById('chartStatistik').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Total Pengajuan',
            'Disetujui',
            'Sudah Didistribusikan',
            'Belum Didistribusikan'
        ],
        datasets: [{
            label: 'Jumlah Pengajuan',
            data: [<?= $totalPengajuan ?>, <?= $verified ?>, <?= $distributed ?>, <?= $belumDistribusi ?>],
            backgroundColor: ['#3498db', '#2ecc71', '#f39c12', '#e74c3c'],
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Grafik Statistik Pengajuan Dana',
                font: { size: 18 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});
</script>

<script src="../Script/akses.js"></script>
</body>
</html>
