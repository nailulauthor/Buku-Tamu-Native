<?php
    @$halaman =$_GET['halaman'];
    if($halaman == "tamu"){
        // Tampilkan halaman tamu
        include "modul/tamu/tamu.php";
    }
    elseif($halaman == "rumah"){
        // Tampilkan halaman warga
        include "modul/rumah/rumah.php";
    }
    elseif($halaman == "keluarga"){
        include "modul/keluarga/keluarga.php";
    }
    elseif($halaman == "berkunjung"){
        if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" ||@$_GET['hal'] == "hapus" ){
            include "modul/berkunjung/form.php";
        }
        else{
            include "modul/berkunjung/berkunjung.php";
        }
    }
    else{
        include "modul/home.php";
    }
?>