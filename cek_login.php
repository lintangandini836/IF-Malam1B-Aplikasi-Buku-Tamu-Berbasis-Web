<?php

session_start();

include "server.php";


$username = mysqli_real_escape_string($conn, $_POST['username']); 
$password = mysqli_real_escape_string($conn, md5($_POST['password']));


$query = mysqli_query($conn,"SELECT * FROM tbl_admin WHERE username= '$username' AND password= '$password'");

$cek = mysqli_num_rows($query);



if($cek > 0){
    $data_admin = mysqli_fetch_assoc($query); 

    $_SESSION['logged_in'] = TRUE;
    $_SESSION['nama_admin'] = $data_admin['nama_admin'];
    $_SESSION['id_admin'] = $row['id'];
    echo "<script>
        alert('Login Berhasil');
        window.location.href= 'Admin.php';
        </script>";
}
else{
     echo "<script>
        alert('Username atau Password salah');
        window.location.href= 'front-end.php';
        </script>";
}
?>