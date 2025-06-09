<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <!-- Style -->
    <link rel="stylesheet" href="../Style/mahasiswa.css">

</head>
<body>
    <!-- Navigasi Bar-->
    <?php include '../Navigasi/navbar.php'; ?>

    <section class="container">
        <!-- Navigasi Main -->
        <?php include '../Navigasi/navmain.php'; ?>

        <!-- Konten Riwayat Start-->
        <section class="pageRiwayat">
            <p>Riwayat Pengajuan</p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Jenis Pengajuan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2025-01-15</td>
                        <td>Pengajuan Beasiswa</td>
                        <td>Rp. 7.000.000</td>
                        <td>Disetujui</td>
                    </tr>
                </tbody>
            </table>
    </section>
    <!-- Konten Riwayat End -->
    <script src="../Script/akses.js"></script>
</body>
</html>