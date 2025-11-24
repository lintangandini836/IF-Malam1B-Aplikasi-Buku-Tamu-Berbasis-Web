<?php
// BARIS BARU: Mulai sesi di baris paling atas
session_start(); 
include("server.php");
// Cek apakah variabel session 'logged_in' ada dan nilainya TRUE
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    // Jika tidak, alihkan pengguna kembali ke halaman depan
    header("Location: front-end.php");
    exit();
}
// Ambil nama admin dari sesi untuk digunakan nanti
$nama_admin_login = isset($_SESSION['nama_admin']) ? $_SESSION['nama_admin'] : '';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Kunjungan PoliBatam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style5.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="logo kampus.png" type="jpg/png">
</head>
<body>

    <div class="containers">
        <header class="header">
            <div class="header-left">
                <img src="logo kampus.png" width="30" alt="Logo PoliBatam" class="logo">
                <span class="app-name">PoliBatam</span>
            </div>
            <div class="header-right">
                <i class="fas fa-user-circle"></i>
                <span><?php echo ($nama_admin_login); ?></span>
            </div>
        </header>

        <div class="main-wrapper">
            <nav class="sidebar">
                <span class="nav-title">Navigasi</span>
                <ul>
                    <li data-page="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
                    <li data-page="buku-tamu" class="active"><i class="fas fa-book"></i> Buku Tamu</li>
                    <li data-page="agenda"><i class="fas fa-calendar-alt"></i> Agenda</li>
                    <li data-page="ganti-sandi"><i class="fas fa-lock"></i> Ganti kata sandi</li>
                    <button type="button" style="background-color: rgba(0, 0, 0, 0);border: none; 
                    color:#f4f4f4;cursor: pointer;" data-bs-toggle="modal" data-bs-target="#logout"><li style="padding-right: 150px;"><i class="fas fa-sign-out-alt"></i> Log Out </li></button>
            </nav>

            <main class="content-area">
                
                <div id="buku-tamu" class="page-content active-page">
                    <h1>Sistem Pencatatan Kunjungan Polibatam</h1>
                    <div class="data-actions">
                        <button class="add-button" data-bs-toggle="modal" data-bs-target="#tambahDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                        <div class="search-box">
                            <input type="text" placeholder="Search:">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <div class="scroll" style="height: 270px; overflow:scroll;">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Lengkap</th>
                                    <th>Asal Instansi</th>
                                    <th>Tujuan</th>
                                    <th>Kedatangan</th>
                                    <th>Kepulangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
include 'server.php';
$query = mysqli_query($conn, "SELECT * FROM data_pengunjung");
while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
<td><?php echo $data['tanggal']?></td>
<td><?php echo $data['nama']; ?></td>
<td><?php echo $data['instansi']; ?></td>
<td><?php echo $data['tujuan']; ?></td>
<td><?php echo $data['kedatangan']; ?></td>
<td><?php echo $data['kepulangan']; ?></td>
<td>
<a href="edit_data.php?id=<?php echo $data['id']; ?>" class="action-btn edit-btn" title="Edit Data"><i class="fas fa-edit"></i></a>
<a href="hapus_data.php?id=<?php echo $data['id']; ?>" 
       onclick="return confirm('Apakah Anda yakin ingin menghapus data <?php echo htmlspecialchars($data['nama']); ?>?');" 
       class="action-btn delete-btn" title="Hapus Data">
        <i class="fas fa-trash-alt"></i>
    </a>
</td>
</tr>
<?php
}
?>                              
</tbody>
</table>
</div>
</div>
                    
                    <div class="pagination">
                        <p class="data-info">Data diatas adalah data tamu diakhir, diurutkan tamu yang terakhir mengisi</p>
                    </div>
                </div> 


                <div id="ganti-sandi" class="page-content">
                    <h1>Ganti Kata Sandi</h1>
                    <div class="form-card">
                        <form>
                            <div class="form-group">
                                <label for="sandi-lama">Kata Sandi Lama</label>
                                <input type="password" id="sandi-lama" class="form-control" placeholder="Masukkan kata sandi lama">
                            </div>

                            <div class="form-group">
                                <label for="sandi-baru">Kata Sandi Baru</label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="sandi-baru" class="form-control" placeholder="Masukkan kata sandi baru">
                                    <i class="fas fa-eye show-password" data-target="sandi-baru"></i>
                                </div>
                                <small class="password-hint">Minimal 8 huruf, terdapat huruf besar</small>
                            </div>

                            <div class="form-group">
                                <div class="password-input-wrapper">
                                    <input type="password" id="konfirmasi-sandi" class="form-control" placeholder="konfirmasi kata sandi baru">
                                    <i class="fas fa-eye show-password" data-target="konfirmasi-sandi"></i>
                                </div>
                            </div>
                            
                            <button type="submit" class="submit-button">Simpan</button>
                        </form>
                    </div>
                </div>

                <div id="dashboard" class="page-content">
                  <h1>Data Kunjungan</h1>
                  <div class="dashboard">
                            <div class="card">
          <h3>Tamu <br>hari ini</h3>
          <p class="number">5</p>
          <i class="fas fa-list icon"></i>
        </div>
        <div class="card">
          <h3>Tamu minggu ini</h3>
          <p class="number">20</p>
          <i class="fas fa-list icon"></i>
        </div>
        <div class="card">
          <h3>Tamu bulan ini</h3>
          <p class="number">50</p>
          <i class="fas fa-list icon"></i>
        </div>
                  </div>
      
                  
                </div>
                <div id="agenda" class="page-content">
                    <h1>Agenda</h1>
                    <p>Konten untuk Agenda akan dimuat di sini.</p>
                </div>
                
            </main>
        </div>
        <!--Modal keluar-->
<div class="modal" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Keluar</h1>
      </div>
      <div class="modal-body">
        Anda yakin ingin keluar?
      </div>
      <div class="modal-footer">
        <a><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button></a>
        <a href="logout.php"><button type="button" class="btn btn-success">Keluar</button></a>
      </div>
    </div>
  </div>
</div>

<!--tambah data-->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pengisian Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="Pengisian_data.php" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div><div class="mb-3">
                <label for="instansi" class="form-label">Asal Instansi</label>
                <input type="text" class="form-control" id="instansi" name="instansi" required>
            </div><div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" required>
            </div>
            <div class="mb-3">
                <label for="kedatangan" class="form-label">Waktu Kedatangan</label>
                <input type="time" class="form-control" id="kedatangan" name="kedatangan" required>
            </div>
                        <div class="mb-3">
                <label for="kepulangan" class="form-label">Waktu Kepulangan</label>
                <input type="time" class="form-control" id="kepulangan" name="kepulangan" required>
            </div>
            <button type="submit" class="btn btn-primary">simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

        <footer class="footer">
            Copyright © **buku kunjungan**. All right reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>