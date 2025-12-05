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

// --- 3. Header untuk File CSV ---

// Nama file yang akan diunduh
$filename = "Laporan_Kunjungan_Polibatam_" . $date_from . "_to_" . $date_to . ".csv";

// Mengatur header agar browser tahu bahwa ini adalah file yang harus diunduh
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Membuka output PHP sebagai file stream
$output = fopen('php://output', 'w');

// Agar data CSV di Excel terbaca dengan baik, terutama karakter non-ASCII, 
// tambahkan BOM (Byte Order Mark) untuk UTF-8.
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// --- 4. Tulis Header Kolom (Judul Tabel) ---

// Definisikan header kolom (sesuaikan dengan urutan kolom di query SQL)
$header = array(
    'Tanggal', 
    'Nama Lengkap', 
    'Asal Instansi', 
    'Tujuan Kunjungan', 
    'Waktu Kedatangan', 
    'Waktu Kepulangan'
);

// Tulis header ke file CSV
fputcsv($output, $header, ';'); // Menggunakan titik koma (;) sebagai delimiter agar mudah dibuka di Excel

// --- 5. Tulis Data ke File CSV ---

// Loop melalui hasil query dan tulis setiap baris data
while ($row = mysqli_fetch_assoc($result)) {
    // fputcsv memerlukan array nilai
    fputcsv($output, $row, ';');
}

// Tutup file stream
fclose($output);

// Hentikan eksekusi script setelah selesai menggenerate file
exit();
?>