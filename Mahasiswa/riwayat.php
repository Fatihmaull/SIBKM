<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sibkm";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_SESSION['id_mahasiswa'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id_mahasiswa'];

$query = "SELECT tanggal_pengajuan, jenis_pengajuan, nominal, status FROM pengajuan_dana WHERE id_mahasiswa = $id ORDER BY tanggal_pengajuan DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Riwayat Pengajuan</title>  
    <link rel="stylesheet" href="../Style/mahasiswa.css">  
</head>  
<body>  
    <!-- Navigasi Bar-->  
    <?php include 'Navigasi/navbar.php'; ?>  

    <section class="container">  
        <!-- Navigasi Main -->  
        <?php include 'Navigasi/navmain.php'; ?>  

        <!-- Konten Riwayat Start-->  
        <section class="pageRiwayat">  
            <h3>Riwayat Pengajuan</h3>  
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
                    <?php
                    if ($result && $result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_pengajuan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['jenis_pengajuan']) . "</td>";
                            echo "<td>Rp. " . number_format($row['nominal'], 0, ',', '.') . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Belum ada pengajuan.</td></tr>";
                    }
                    ?>
                </tbody>  
            </table>  
        </section>  
        <!-- Konten Riwayat End -->  
    </section>

    <script src="../script.js"></script>
</body>  
</html>