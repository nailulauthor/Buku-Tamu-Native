<?php
    session_start();
    unset($_SESSION['idadmin'] );
    unset($_SESSION['username']);
    
    session_destroy();
    echo "<script>
    alert('Anda telah keluar dari Halaman Admin');
    document.location ='index.php';
    </script>";
