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
            <section class="history-section">
                <h2>History Pengajuan Dicairkan</h2>
                <div class="history-table-wrapper">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Nama Mahasiswa</th>
                                <th>No. Rekening</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Beasiswa</td>
                                <td>Rp 5.000.000</td>
                                <td>Rizki Pratama</td>
                                <td>1234567890</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>UKT</td>
                                <td>Rp 2.500.000</td>
                                <td>Siti Nurhaliza</td>
                                <td>9876543210</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script src="../Script/akses.js"></script>
</body>

</html>