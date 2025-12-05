<?php 
include 'server.php';
$nama = $_POST['nama'];
$instansi = $_POST['instansi'];
$tujuan = $_POST['tujuan'];
$kedatangan = $_POST['kedatangan'];
$kepulangan = $_POST['kepulangan'];
$input = mysqli_query($conn,"INSERT INTO data_pengunjung (tanggal, nama, instansi, tujuan, kedatangan,kepulangan) VALUES(current_timestamp(), '$nama', '$instansi'
,'$tujuan', '$kedatangan', '$kepulangan')") or die(mysqli_error($conn));

 if($input){
    echo "<script>
            alert('Data Berhasil Disimpan');
            window.location.href= 'admin.php';
            </script>";
 }else{
    echo "<script>
            alert('Data Gagal Disimpan');
            window.location.href= 'admin.php';
            </script>";
 }


?>