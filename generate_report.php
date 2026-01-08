<?php
// Pastikan file server.php (koneksi database) sudah di-include
include('server.php');

// --- 1. Ambil dan Validasi Input Tanggal ---

// Pastikan tanggal diterima dan tidak kosong
if (!isset($_GET['date_from']) || !isset($_GET['date_to']) || empty($_GET['date_from']) || empty($_GET['date_to'])) {
    // Jika tanggal tidak ada, redirect kembali atau tampilkan pesan error
    die("Error: Rentang tanggal tidak valid.");
}

// Ambil tanggal dan bersihkan input
$date_from = mysqli_real_escape_string($conn, $_GET['date_from']);
$date_to = mysqli_real_escape_string($conn, $_GET['date_to']);

// --- 2. Query Database ---

// Query untuk mengambil semua data pengunjung dalam rentang tanggal
$sql = "SELECT tanggal, nama, instansi, tujuan, kedatangan, kepulangan 
        FROM data_pengunjung 
        WHERE tanggal BETWEEN '$date_from' AND '$date_to'
        ORDER BY tanggal ASC, kedatangan ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

// Cek apakah ada data yang ditemukan
if (mysqli_num_rows($result) == 0) {
    // Redirect atau tampilkan pesan jika tidak ada data
    die("Tidak ada data kunjungan untuk rentang tanggal tersebut.");
}


// Ganti bagian header Anda dengan ini
$filename = "Laporan_Kunjungan_Polibatam_" . $date_from . "_to_" . $date_to . ".xls";

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");;

// --- 4. Mulai Output Tabel ---
?>
<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
<style>
    .title {
        font-size: 16pt;
        font-weight: bold;
        text-align: center;
    }
    .table-header {
        background-color: #e0e0e0;
        font-weight: bold;
        border: 1px solid #000;
    }
    td {
        border: 1px solid #000;
        vertical-align: top;
    }
</style>

<table>
    <tr>
        <th colspan="6" class="title">DATA KUNJUNGAN BUKU TAMU</th>
    </tr>
    <tr>
        <th colspan="6" style="text-align: center;">Periode: <?php echo $date_from; ?> s/d <?php echo $date_to; ?></th>
    </tr>
    <tr><th colspan="6"></th></tr> <thead>
        <tr>
            <th class="table-header">Tanggal</th>
            <th class="table-header">Nama Lengkap</th>
            <th class="table-header">Asal Instansi</th>
            <th class="table-header">Tujuan Kunjungan</th>
            <th class="table-header">Waktu Kedatangan</th>
            <th class="table-header">Waktu Kepulangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // --- 5. Tulis Data dari Database ---
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['instansi']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tujuan']) . "</td>";
            echo "<td>" . htmlspecialchars($row['kedatangan']) . "</td>";
            echo "<td>" . htmlspecialchars($row['kepulangan']) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
exit();
?>