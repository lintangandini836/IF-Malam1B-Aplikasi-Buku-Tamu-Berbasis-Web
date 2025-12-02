<?php 

$host="localhost";
$user= "root";
$pass= "";
$db="dbs_buku_tamu";

$conn=mysqli_connect($host,$user,$pass,$db);

if (!$conn) {
    echo "failed to connect DB";
}
else{
   // echo "conected";
}
?>