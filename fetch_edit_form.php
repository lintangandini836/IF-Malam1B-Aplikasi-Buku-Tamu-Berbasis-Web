<?php
session_start();
include "server.php"; 

// Pengecekan keamanan
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    http_response_code(401);
    die("Akses ditolak.");
}

// Hanya proses jika ID diberikan
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_edit = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = mysqli_query($conn, "SELECT * FROM data_pengunjung WHERE id = '$id_edit'");
    
    if (mysqli_num_rows($query) === 1) {
        $data_edit = mysqli_fetch_assoc($query);

        // MULAI MENCETAK FORMULIR HTML
        ?>
        <form action="Admin.php" method="POST">
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
            
            <div class="modal-footer-custom pt-3 border-top">
                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
        <?php

    } else {
        echo '<div class="alert alert-danger">Data dengan ID tersebut tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID data tidak valid.</div>';
}

mysqli_close($conn);
?>