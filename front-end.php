<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Politeknik Negeri Batam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="logo kampus.png" type="jpg/png">
    <style>
        html { scroll-behavior: smooth; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: sans-serif; }
        body { background-color: #1756861e }

        /* NAVBAR */
        .navbar-custom {
            display: flex;
            justify-content: space-between;
            padding: 10px 50px;
            align-items: center;
            background-color: #175586;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo { display: flex; gap: 10px; align-items: center; }
        .logo img { width: 40px; height: 40px; }
        .logo span { font-weight: 700; color: white; font-size: 18px; }
        nav a { padding: 0 15px; text-decoration: none; color: white; font-weight: 500; transition: 0.3s; }
        nav a:hover { color: #0fbcf9; }

        .btn-login-top {
            background-color: #0fbcf9;
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 13px;
        }

        /* Beranda */
        .hero {
            background: linear-gradient(to right, #175586, #2A99AA);
            color: white;
            text-align: center;
            padding: 130px 20px;
            padding-top: 50px;
        }
        .hero h1 { font-size: 36px; font-weight: 800; margin-bottom: 30px;}
        .btn-action {
            background-color: #0fbcf9;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
        }

        /* Layanan Website */
        .menu-section { display: flex; justify-content: center; gap: 60px; flex-wrap: wrap; margin: -50px auto 50px auto; padding: 0 20px; }
        .menu-item {
            background: white;
            padding: 25px;
            width: 220px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .menu-item:hover { transform: translateY(-10px); }
        .menu-item i { color: #175586; font-size: 40px; margin-bottom: 15px; }
        .menu-item p { font-weight: bold; font-size: 14px; color: #333; }

        /* Tentang */
        .tentang-section { padding: 80px 20px; text-align: center; }
        .tentang-section h2 { font-weight: 700; color: #175586; margin-bottom: 20px; }
        .tentang-section p { max-width: 800px; margin: 0 auto 40px auto; line-height: 1.8; color: #555;font-weight: 600; }

        .dev-container { display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; }
        .dev-card {
            background: #175686d0;
            border-radius: 12px;
            overflow: hidden;
            width: 200px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .dev-card:hover{transform: translateY(-10px);}
        .dev-card img { width: 100%; height: 220px; object-fit: cover; }
        .dev-card p { padding: 15px; font-weight: 600; font-size: 14px; margin: 0;color: white;}

        /* Masukan Dan Saran */
        .masukan-section { padding: 80px 20px; background:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('poltek.jpg') }
        .masukan-container {
            display: flex;
            background: white;
            max-width: 1000px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .masukan-image { flex: 1; display: flex; align-items: center; justify-content: center; background: #eee; }
        .masukan-image img { width: 100%; height: 100%; object-fit: cover; }
        .form-box { flex: 1; padding: 40px; color: #333; }
        .form-box input, .form-box textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .btn-submit { background: #175586; color: white; border: none; padding: 10px 30px; border-radius: 5px; width: 100%; }

        /* Footer */
        .footer { background: #0b3c75; color: white; text-align: center; padding: 30px 20px; font-size: 17px; }

        /* Modal */
        .modal-content { border-radius: 15px; padding: 20px; }
        input[type="text"],
        input[type="password"]
        {
            font-family: arial, sans-serif;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }
        .modal .btn{
            background-color: #0fbcf9;
            color:white;
        }
    </style>
</head>
<body>

    <header class="navbar-custom">
        <div class="logo">
            <a href="front-end.php" style="text-decoration:none;">
                <img src="logo kampus.png" alt="Polibatam">
                <span>Polibatam</span>
            </a>
        </div>
        <nav>
            <a href="#beranda">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#masukan">Masukan dan Saran</a>
        </nav>
        <button class="btn-login-top" data-bs-toggle="modal" data-bs-target="#loginAdminModal">
            Login Sebagai Admin
        </button>
    </header>

    <section id="beranda">
        <div class="hero">
            <h1>Selamat Datang Di Website Tata Usaha<br>Politeknik Negeri Batam</h1>
            <button class="btn-action" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                <i class="bi bi-plus-circle"></i> Buat Data Kunjungan
            </button>
        </div>

        <div class="menu-section">
            <div class="menu-item">
                <i class="fa-solid fa-file"></i>
                <p>Legalitas Dokumen Akademik</p>
            </div>
            <div class="menu-item">
                <i class="fa-solid fa-folder"></i>
                <p>Pengurusan Absensi</p>
            </div>
            <div class="menu-item">
                <i class="fa-solid fa-message"></i>
                <p>Administrasi UKT</p>
            </div>
            <div class="menu-item">
                <i class="fa-solid fa-clock"></i>
                <p>Layanan Surat</p>
            </div>
        </div>
    </section>

    <section id="tentang" class="tentang-section">
        <div class="container">
            <h2>Tentang Website ini</h2>
            <p>
                Website ini merupakan catatan riwayat kunjungan tamu yang datang ke kampus Politeknik Negeri Batam. 
                Tujuannya agar pihak kampus bisa mendata kunjungan dengan lebih tertata untuk seminar, kunjungan instansi, maupun agenda umum lainnya.
            </p>

            <h2 class="mt-5">Developer Website</h2>
            <p class="mb-4">Website ini dibuat oleh Kelompok satu dari kelas IF-1B Malam, yang terdiri dari tiga anggota</p>
            <div class="dev-container">
                <div class="dev-card">
                    <img src="alan.png" alt="Alan">
                    <p>Alan Farah Rohid T</p>
                </div>
                <div class="dev-card">
                    <img src="lintang.png" alt="Lintang">
                    <p>Lintang Putri Andini</p>
                </div>
                <div class="dev-card">
                    <img src="rafli.png" alt="Rafli">
                    <p>Muhammad Rafli Akbar S</p>
                </div>
            </div>
        </div>
    </section>

    <section id="masukan" class="masukan-section">
        <div class="masukan-container">
            <div class="form-box">
                <h3 class="mb-4 text-center">Masukan & Saran</h3>
                <form action="saran.php" method="POST">
    <label class="mb-3 fw-bold">Nama Lengkap:</label>
    <input type="text" name="nama" placeholder="Masukkan nama" required>
    
    <div class="mb-3">
        <label for="jenisKelamin" class="mb-3 fw-bold">Jenis Kelamin :</label>
        <select class="form-select" id="jenisKelamin" name="jenis" required>
            <option selected disabled>Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Wanita">Wanita</option>
        </select>
    </div>

    <label class="mb-3 fw-bold">E-mail:</label>
    <input type="email" name="email" placeholder="email@contoh.com" required>

    <label class="mb-3 fw-bold">Saran Anda:</label>
    <textarea name="masukan_saran" placeholder="Tuliskan masukan di sini..." rows="4" required></textarea>

    <button type="submit" class="btn-submit">Kirim</button>
</form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p class="fw-bold">Tata Usaha Politeknik Negeri Batam</p>
        <div style="display:flex; justify-content: space-around; ">
            <p><i class="fa-solid fa-location-dot"></i> Jl. Ahmad Yani Batam Kota. Kota Batam. kepulauan Riau. Indonesia</p>
            <p><i class="fa-solid fa-phone"></i> Phone : +62-778-469858 Ext.1017 </p>
            <p><i class="fa-solid fa-envelope"></i> Email : info@polibatam.ac.id</p>
        </div>
    </footer>


    <div class="modal fade" id="loginAdminModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:430px;font-family:;">
            <div class="modal-content">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                <div class="text-center">
                    <img src="logo kampus.png" alt="logo" style="width: 50%;margin: 30px; ">
                </div>
                <form action="cek_login.php" method="POST" class="p-3">
                    <div class="mb-3">
                        <label class="mb-2" style="font-size:13px; font-weight:600;">Nama Pengguna:</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Nama Pengguna" required>
                    </div>
                    <div class="mb-5">
                        <label class="mb-2" style="font-size:13px; font-weight:600;">Kata Sandi :</label>
                        <input type="password" class="form-control" placeholder="Masukkan Kata Sandi" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahDataModal" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Formulir Kunjungan Tamu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="pengisian_data.php" method="POST" class="p-3">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Asal Instansi</label>
                            <input type="text" class="form-control" name="instansi" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Tujuan Kunjungan</label>
                            <input type="text" class="form-control" name="tujuan" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Waktu Datang</label>
                            <input type="time" class="form-control" name="kedatangan" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Waktu Pulang</label>
                            <input type="time" class="form-control" name="kepulangan" required>
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 py-2 mt-1">Simpan Data Kunjungan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>