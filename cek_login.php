<?php
 session_start();
include "config/koneksi.php";


// password dienkripsi md5
@$pass = md5($_POST['password']);

//  mysqli_escape_tring fungsinya untuk mengamankan karakter aneh yang diinputkan user 
// , sperti sql injection-->

@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);

$login = mysqli_query($koneksi, "SELECT * from user 
WHERE username='$username' AND password = '$password'");

$data = mysqli_fetch_array($login);
if($data)
{
    $_SESSION['idadmin'] = $data['idadmin'];
    $_SESSION['username'] = $data['username'];
    header('location:admin.php');

}
else{
    echo "<script>
        alert('Login GAGAL, pastikan username dan password benar!!!!');
        document.location='index.php';
        </script>";
}