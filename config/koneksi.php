<?php
// Untuk identitas server
$server = "localhost";
$user   = "root";
$password = "";
$database = "dblaportamu";

// Koneksi Database
$koneksi = mysqli_connect($server, $user, $password, $database) 
or die (mysqli_error($koneksi));
?>