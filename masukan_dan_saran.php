<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buku Tamu Kunjungan</title>
        <link rel="stylesheet" href="style4.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="icon" href="logo kampus.png" type="jpg/png">
      </head>
    <body>
        <!--Buat Navbarnya dlu-->
        <header>
            <div class="navbar">
                <div class="logo">
                    <img src="logo kampus.png" alt="Polibatam">
                    <Span>Polibatam</Span>
                </div>
                <nav>
                    <a href="front-end.php">Beranda</a>
                    <a href="tentang.php">Tentang</a>
                    <a href="masukan_dan_saran.php">Masukan dan saran</a>
                </nav>
                     <button type="button" class="button-primary">
        Login Sebagai Admin
      </button>
            </div>
        </header>

  <section class="main-section">
    <div class="container">
      <div class="image-box">
        <img src="poltek.jpg" alt="Polibatam">
      </div>

      <div class="form-box">
        <form>
          <label>Nama</label>
          <input type="text" placeholder="Masukkan nama Anda">

          <label>Jenis kelamin</label>
          <div class="gender">
            <label><input type="radio" name="gender"> Pria</label>
            <label><input type="radio" name="gender"> Wanita</label>
          </div>


          <label>Email</label>
          <input type="email" placeholder="Masukkan email">

          <label>Masukan dan saran</label>
          <textarea placeholder="Tulis saran Anda di sini..."></textarea>

          <button type="submit" class="submit-btn">Kirim</button>
        </form>
      </div>
    </div>
  </section>

        <footer class="footer">
    <p>Tata Usaha Politeknik Negeri Batam</p>        
    <p><i class="fa-solid fa-location-dot"></i> Jl. Ahmad Yani, Batam Centre - Kepulauan Riau | <i class="fa-solid fa-phone"></i> 107781 468855 Ext 102 | <i class="fa-solid fa-envelope"></i> TU@polibatam.ac.id</p>
  </footer>    
</body>
</html>