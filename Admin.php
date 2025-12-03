<?php
// BARIS BARU: Mulai sesi di baris paling atas
session_start(); 
include("server.php");

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    
    header("Location: front-end.php");
    exit();
}
$nama_admin_login = isset($_SESSION['nama_admin']) ? $_SESSION['nama_admin'] : '';

$today = date('Y-m-d');
$sql_today = "SELECT COUNT(*) AS count_today FROM data_pengunjung WHERE tanggal = '$today'";
$result_today = mysqli_query($conn, $sql_today);
$row_today = mysqli_fetch_assoc($result_today);
$count_today = $row_today['count_today'];

// 2. Statistik Tamu Minggu Ini
$start_of_week = date('Y-m-d', strtotime('monday this week'));
$end_of_week = date('Y-m-d', strtotime('sunday this week'));
$sql_week = "SELECT COUNT(*) AS count_week FROM data_pengunjung 
             WHERE tanggal BETWEEN '$start_of_week' AND '$end_of_week'";
$result_week = mysqli_query($conn, $sql_week);
$row_week = mysqli_fetch_assoc($result_week);
$count_week = $row_week['count_week'];

// 3. Statistik Tamu Bulan Ini
// Mengambil tanggal awal dan akhir dari bulan ini
$start_of_month = date('Y-m-01');
$end_of_month = date('Y-m-t'); // 't' mengembalikan jumlah hari dalam bulan
$sql_month = "SELECT COUNT(*) AS count_month FROM data_pengunjung 
              WHERE tanggal BETWEEN '$start_of_month' AND '$end_of_month'";
$result_month = mysqli_query($conn, $sql_month);
$row_month = mysqli_fetch_assoc($result_month);
$count_month = $row_month['count_month'];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Kunjungan PoliBatam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style3.css"> 
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
                <span>Selamat Datang, <?php echo ($nama_admin_login); ?></span>
            </div>
        </header>

        <div class="main-wrapper">
            <nav class="sidebar">
                <span class="nav-title">Navigasi</span>
                <ul>
                    <li data-page="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
                    <li data-page="buku-tamu" class="active"><i class="fas fa-book"></i> Buku Tamu</li>
                    <li data-page="agenda"><i class="fa-solid fa-file"></i> Laporan</li>
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
                            <form method="GET" action="Admin.php" style="display: flex;">
                                <input type="search" placeholder="Search:" name="search_query" value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                                <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
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

// Cek apakah ada parameter 'search_query' yang dikirim melalui GET
$search_query = "";
if (isset($_GET['search_query']) && !empty(trim($_GET['search_query']))) {
    // Ambil dan bersihkan input pencarian
    $search_query = mysqli_real_escape_string($conn, $_GET['search_query']);
    // Tentukan query SQL dengan klausa WHERE untuk mencari data
    // Menggunakan LIKE %...% untuk pencarian yang fleksibel (nama, instansi, atau tujuan)
    $sql_query = "SELECT * FROM data_pengunjung 
                  WHERE nama LIKE '%$search_query%' 
                  OR instansi LIKE '%$search_query%' 
                  OR tujuan LIKE '%$search_query%'
                  ORDER BY id DESC"; // Diurutkan berdasarkan ID terbaru (sesuaikan jika perlu)
} else {
    // Jika tidak ada pencarian, gunakan query default
    $sql_query = "SELECT * FROM data_pengunjung ORDER BY id DESC";
}

// Jalankan query yang sudah ditentukan
$query = mysqli_query($conn, $sql_query);

// Cek jika query gagal
if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}

// Mulai perulangan untuk menampilkan data
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
<button class="btn btn-success btn-sm  edit-button" style="padding: 2px 7px; padding-top: 2px; "
data-bs-target="#edit_data"
data-bs-toggle="modal"
data-id="<?php echo $data['id'];?>"
data-nama="<?php echo $data['nama'];?>"
data-instansi="<?php echo $data['instansi'];?>"
data-tujuan="<?php echo $data['tujuan'];?>"
data-kedatangan="<?php echo $data['kedatangan'];?>"
data-kepulangan="<?php echo $data['kepulangan'];?>">
<i class="fas fa-edit"></i></button>
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
                        <p class="data-info">Data diatas merupakan data yang diurutkan dari tamu yang terakhir mengisi formulir.</p>
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
            <p class="number"><?php echo $count_today; ?></p>
            <i class="fas fa-list icon"></i>
        </div>
        <div class="card">
            <h3>Tamu minggu ini</h3>
            <p class="number"><?php echo $count_week; ?></p>
            <i class="fas fa-list icon"></i>
        </div>
        <div class="card">
            <h3>Tamu bulan ini</h3>
            <p class="number"><?php echo $count_month; ?></p>
            <i class="fas fa-list icon"></i>
        </div>
    </div>
</div>
                <div id="agenda" class="page-content">
                    <h1>Laporan Kunjungan Tamu</h1>

                    <div class="report-form-container">
                        <form action="generate_report.php" method="GET" class="report-form-flex">
                            
                            <div class="form-group date-field">
                                <label for="date-from">Dari Tanggal</label>
                                <input type="date" id="date-from" name="date_from" class="datepicker" value="<?php echo date('Y-m-01') ?>" required>
                            </div>

                            <div class="form-group date-field">
                                <label for="date-to">Sampai Tanggal</label>
                                <input type="date" id="date-to" name="date_to" class="datepicker" value="<?php echo date('Y-m-d')?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary generate-button">
                                <i class="fas fa-file-export"></i> Cetak Laporan
                            </button>
                        </form>
                    </div>
                    
                    <div id="report-info" class="mt-4">
                        <p>Pilih rentang tanggal di atas dan klik **Cetak Laporan** untuk mengunduh data kunjungan dalam format CSV (Excel).</p>
                    </div>
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
<!--edit modal-->
<div class="modal fade" id="edit_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pengisian Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="edit_data.php" method="post">
                <input type="hidden" name="id" id="edit-id">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="edit-nama" name="nama" required>
            </div><div class="mb-3">
                <label for="instansi" class="form-label">Asal Instansi</label>
                <input type="text" class="form-control" id="edit-instansi" name="instansi" required>
            </div><div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <input type="text" class="form-control" id="edit-tujuan" name="tujuan" required>
            </div>
            <div class="mb-3">
                <label for="kedatangan" class="form-label">Waktu Kedatangan</label>
                <input type="time" class="form-control" id="edit-kedatangan" name="kedatangan" required>
            </div>
                        <div class="mb-3">
                <label for="kepulangan" class="form-label">Waktu Kepulangan</label>
                <input type="time" class="form-control" id="edit-kepulangan" name="kepulangan" required>
            </div>
            <button type="submit" class="btn btn-primary">simpan</button>
        </form>
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
            <input type="hidden" name="id" value="<?php echo $data_edit['id']; ?>">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const editButtons =document.querySelectorAll('.edit-button');
    editButtons.forEach(button =>{
      button.addEventListener('click', function(){
        const id = this.getAttribute('data-id');
        const nama = this.getAttribute('data-nama');
        const instansi = this.getAttribute('data-instansi');
        const tujuan = this.getAttribute('data-tujuan');
        const kedatangan = this.getAttribute('data-kedatangan');
        const kepulangan = this.getAttribute('data-kepulangan');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value= nama;
        document.getElementById('edit-instansi').value= instansi;
        document.getElementById('edit-tujuan').value= tujuan;
        document.getElementById('edit-kedatangan').value= kedatangan;
        document.getElementById('edit-kepulangan').value= kepulangan;
      });
    });
  });
    </script>
</body>
</html>
