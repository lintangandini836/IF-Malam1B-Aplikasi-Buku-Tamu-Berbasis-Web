<?php
include 'server.php'; // Pastikan koneksi database sudah benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jenis']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $masukan_saran = mysqli_real_escape_string($conn, $_POST['masukan_saran']);

    $query = "INSERT INTO saran (nama, jenis, email, masukan_saran) VALUES ('$nama', '$jk', '$email', '$masukan_saran')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Terima kasih! Saran Anda telah terkirim.'); window.location='front-end.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>