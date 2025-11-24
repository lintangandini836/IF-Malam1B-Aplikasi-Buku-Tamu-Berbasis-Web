<?php
session_start();
include "server.php"; 

// Pengecekan keamanan: Hanya admin yang login yang boleh mengakses
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    header("Location: front-end.php");
    exit();
}

$data_edit = null;
$message = '';

// --- LOGIKA UPDATE (UPDATE LOGIC) ---
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $instansi = mysqli_real_escape_string($conn, $_POST['instansi']);
    $tujuan = mysqli_real_escape_string($conn, $_POST['tujuan']);
    $kedatangan = mysqli_real_escape_string($conn, $_POST['kedatangan']);
    $kepulangan = mysqli_real_escape_string($conn, $_POST['kepulangan']);

    // Query UPDATE: Menggunakan kolom ID untuk menentukan data mana yang diubah
    $sql_update = "UPDATE data_pengunjung SET 
                    nama = '$nama', 
                    instansi = '$instansi', 
                    tujuan = '$tujuan', 
                    kedatangan = '$kedatangan', 
                    kepulangan = '$kepulangan' 
                    WHERE id = '$id'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href= 'Admin.php';
        </script>";
        exit();
    } else {
        $message = "Error saat memperbarui data: " . mysqli_error($conn);
    }
}

// --- LOGIKA AMBIL DATA LAMA (FETCH DATA LOGIC) ---
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_edit = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = mysqli_query($conn, "SELECT * FROM data_pengunjung WHERE id = '$id_edit'");
    
    if (mysqli_num_rows($query) === 1) {
        $data_edit = mysqli_fetch_assoc($query);
    } else {
        $message = "Data tidak ditemukan.";
    }
} else {
    $message = "ID data tidak diberikan.";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Kunjungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style5.css"> <style>
        body { padding: 40px; background-color: #f8f9fa; }
        .container-edit { max-width: 600px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container-edit">
        <h2 class="mb-4">Edit Data Pengunjung</h2>
        <?php if ($message): ?>
            <div class="alert alert-warning"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($data_edit): ?>
        <form action="edit_data.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data_edit['id']; ?>">
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data_edit['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="instansi" class="form-label">Asal Instansi</label>
                <input type="text" class="form-control" id="instansi" name="instansi" value="<?php echo htmlspecialchars($data_edit['instansi']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo htmlspecialchars($data_edit['tujuan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kedatangan" class="form-label">Waktu Kedatangan</label>
                <input type="time" class="form-control" id="kedatangan" name="kedatangan" value="<?php echo htmlspecialchars($data_edit['kedatangan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kepulangan" class="form-label">Waktu Kepulangan</label>
                <input type="time" class="form-control" id="kepulangan" name="kepulangan" value="<?php echo htmlspecialchars($data_edit['kepulangan']); ?>" required>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            <a href="Admin.php" class="btn btn-secondary">Batal</a>
        </form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>