<?php
session_start();
include("server.php");

// Tambahkan proteksi ini
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    header("Location: front-end.php");
    exit();
}
$id = $_POST["id"];
$nama = $_POST["nama"];
$instansi = $_POST["instansi"];
$tujuan = $_POST["tujuan"];
$kedatangan = $_POST["kedatangan"];
$kepulangan = $_POST["kepulangan"];
$result = mysqli_query($conn,"UPDATE data_pengunjung SET nama='$nama',instansi='$instansi', tujuan='$tujuan', kedatangan='$kedatangan',kepulangan='$kepulangan' WHERE id='$id'");

if (!$result) {
    echo "Terdapat Masalah Saat Memperbarui Data";
}
else{

    header("location: Admin.php");
}



?>