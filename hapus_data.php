<?php
session_start();
include "server.php"; // Pastikan koneksi ($conn) ada

// Pengecekan keamanan: Hanya admin yang login yang boleh menghapus
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    header("Location: front-end.php");
    exit();
}

// 1. Ambil ID dari URL (GET request) dan validasi
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Amankan ID dari SQL Injection
    $id_hapus = mysqli_real_escape_string($conn, $_GET['id']);
    
    // 2. Query DELETE
    $sql_delete = "DELETE FROM data_pengunjung WHERE id = '$id_hapus'";
    
    // 3. Eksekusi query
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>
            alert('Data berhasil dihapus.');
            window.location.href= 'Admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus: " . mysqli_error($conn) . "');
            window.location.href= 'Admin.php';
        </script>";
    }
} else {
    // Jika ID tidak valid
    echo "<script>
        alert('ID data tidak valid.');
        window.location.href= 'Admin.php';
    </script>";
}

mysqli_close($conn);
?>