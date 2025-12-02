<?php include("server.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 <link rel="icon" href="logo kampus.png" type="jpg/png">
</head>
<body>
         <!--Navbar-->
        <header>
            <div class="navbar">
                <div class="logo">
                    <img src="logo kampus.png" alt="Polibatam">
                    <Span>Polibatam</Span>
                </div>
                <nav>
                    <a href="">Beranda</a>
                    <a href="tentang.php">Tentang</a>
                    <a href="masukan_dan_saran.php">Masukan dan saran</a>
                </nav>
           <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#loginadmin">
          Login Sebagai Admin
        </button>
            </div>
        </header>

        <!--hero section-->
        <section class="hero">
            <h1>Selamat Datang Di Website Tata Usaha<br>Politeknik Negeri Batam</h1>
            <div class="hero-buttons">
            <button class="button" data-bs-toggle="modal" data-bs-target="#tambahDataModal">Buat Data Kunjungan</button></a>
            </div>
        </section>

        <!--ini buat modal tambah data-->
<div class="pengisian_data">
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-body">
                    <form action="pengisian_data.php" style="width: 40%; background-color:white;" method="post">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left: 90%;"></button>   
                    <h3 style="text-align: center;">Pengisian Formulir</h3>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Asal Instasi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" required>
                        </div>
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Waktu Kedatangan</label>
                            <input type="time" class="form-control" id="kedatangan" name="kedatangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="kepulangan" class="form-label">Waktu Kepulangan</label>
                            <input type="time" class="form-control" id="kepulangan" name="kepulangan" required>
                        </div>
                        <button type="submit" style="margin-left:30px; width:80%;" class="btn btn-primary">simpan</button>
                        <div class="modal-dialog">
        </form>
    </div>
</div>
</div>
</div>
</div>

        <!--Menu Section-->
        <section class="menu">
            <div class="menu-item">
                <i class="fa-solid fa-file"></i>
                <p>Legalitas Dokumen Akademik</p>
            </div>
            <div class="menu-item">
                <i class="fa-solid fa-folder"></i>
                <p>Perizinan Dan Perbaikan Absensi</p>
            </div>
            <div class="menu-item">
                <i class="fa-solid fa-message"></i>
                <p>Administrasi UKT</p>
            </div>
            <div class="menu-item">
                <i class="fa-solid fa-clock"></i>
                <p>Layanan Surat Mahasiswa</p>
            </div>
        </section>
        
        <!-- Pop Up Login -->
         <div class="login-admin">
             <div class="modal fade" id="loginadmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <form action="cek_login.php" style="background-color:white;" method="post">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left: 90%;"></button>
                     <img src="logo kampus.png" sizes="5px" alt="rounded" class="rounded" >
                     
                     <label for="username">Nama Pengguna:</label>
                     <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                     
                     <label for="Password">Kata Sandi:</label>
                     <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                     <br>
                     <br>
                     <a href="" >Lupa Password?</a>
                     
                     <button class="button_login" type="submit">Login</button>
                     <div class="modal-dialog">
                         </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
    <p>Tata Usaha Politeknik Negeri Batam</p>        
    <p><i class="fa-solid fa-location-dot"></i> Jl. Ahmad Yani, Batam Centre - Kepulauan Riau | <i class="fa-solid fa-phone"></i> 107781 468855 Ext 102 | <i class="fa-solid fa-envelope"></i> TU@polibatam.ac.id</p>
  </footer>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>