<?php
session_start();
include("server.php");

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    header("Location: front-end.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_saran'])) {
    $ids = $_POST['id_saran']; // Ini adalah array ID dari checkbox
    
    // Mengamankan ID dan menggabungkannya untuk query SQL
    $all_ids = implode(",", array_map('intval', $ids));
    
    $sql = "DELETE FROM saran WHERE id IN ($all_ids)";
    
    if (mysqli_query($conn, $sql)) {
        // Berhasil, kembalikan ke halaman admin
        echo "<script>alert('Pesan berhasil dihapus'); window.location='Admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus: " . mysqli_error($conn) . "'); window.location='Admin.php';</script>";
    }
} else {
    // Jika mencoba akses langsung tanpa pilih pesan
    header("Location: Admin.php");
}
?>