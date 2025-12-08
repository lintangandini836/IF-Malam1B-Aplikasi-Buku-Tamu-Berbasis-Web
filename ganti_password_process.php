<?php
session_start();
include("server.php"); // Memuat koneksi $conn


// Ambil data yang dikirim dari form
$nama_admin = $_SESSION['nama_admin']; // Ambil nama admin dari sesi (berfungsi sebagai kunci)
$sandi_lama = $_POST['sandi_lama'];
$sandi_baru = $_POST['sandi_baru'];
$konfirmasi_sandi = $_POST['konfirmasi_sandi'];

// Untuk keamanan, bersihkan input
$nama_admin_bersih = mysqli_real_escape_string($conn, $nama_admin);
// Catatan: Karena di cek_login.php Anda menggunakan md5(), kita harus menggunakan md5() juga di sini. 
// Namun, sangat disarankan untuk menggunakan fungsi hashing modern seperti password_hash().
$sandi_lama_md5 = md5($sandi_lama); 
$sandi_baru_md5 = md5($sandi_baru);

// =======================================================
// 2. VALIDASI INPUT
// =======================================================

// Cek apakah Sandi Baru dan Konfirmasi Sandi Baru sama
if ($sandi_baru !== $konfirmasi_sandi) {
    echo "<script>
        alert('Kata Sandi Baru dan Konfirmasi Kata Sandi tidak cocok!');
        window.location.href= 'Admin.php?page=ganti-sandi'; // Kembali ke halaman ganti sandi
        </script>";
    exit();
}

// Optional: Tambahkan validasi panjang/kompleksitas sandi
if (strlen($sandi_baru) < 8) {
    echo "<script>
        alert('Kata Sandi Baru minimal harus 8 karakter!');
        window.location.href= 'Admin.php?page=ganti-sandi';
        </script>";
    exit();
}


// =======================================================
// 3. VERIFIKASI SANDI LAMA DI DATABASE
// =======================================================

// Query untuk mengambil data admin berdasarkan nama dan sandi lama
// Asumsi: 'nama_admin' adalah kolom yang unik, atau 'username' di tbl_admin sama dengan 'nama_admin' di sesi
// Berdasarkan cek_login.php, kita menggunakan kolom 'username' dan 'password'
$query_check = "SELECT username FROM tbl_admin WHERE nama_admin = '$nama_admin_bersih' AND password = '$sandi_lama_md5'"; 
$result_check = mysqli_query($conn, $query_check);

if (mysqli_num_rows($result_check) == 0) {
    // Sandi lama tidak cocok dengan yang ada di database
    echo "<script>
        alert('Kata Sandi Lama Salah. Pembaruan dibatalkan.');
        window.location.href= 'Admin.php?page=ganti-sandi';
        </script>";
    exit();
}

// =======================================================
// 4. UPDATE SANDI BARU KE DATABASE
// =======================================================

// Query UPDATE untuk mengganti sandi
$query_update = "UPDATE tbl_admin SET password = '$sandi_baru_md5' WHERE nama_admin = '$nama_admin_bersih'";

if (mysqli_query($conn, $query_update)) {
    // Jika update berhasil
    echo "<script>
        alert('Kata Sandi Berhasil Diperbarui!');
        window.location.href= 'Admin.php'; // Arahkan ke Dashboard/Halaman utama Admin
        </script>";
} else {
    // Jika update gagal (masalah koneksi/database)
    echo "<script>
        alert('Gagal memperbarui Kata Sandi: " . mysqli_error($conn) . "');
        window.location.href= 'Admin.php?page=ganti-sandi';
        </script>";
}

// Tutup koneksi
mysqli_close($conn);
?>