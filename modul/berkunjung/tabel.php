<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "dblaportamu";

$q1="";
$koneksi = mysqli_connect($host,$user,$pass,$db);
$sql1="SELECT berkunjung.*,
tbltamu.nama_tamu, tbltamu.alamat_tamu, tbltamu.nohp,
 keluarga.nama, tbrumah.no_rumah, tbrumah.alamat, keluarga.nohp1 
 FROM berkunjung, tbrumah, tbltamu, keluarga
  WHERE berkunjung.idtamu = tbltamu.idtamu 
  AND keluarga.no_rumah = tbrumah.no_rumah 
  AND berkunjung.idkeluarga = keluarga.idkeluarga
  order by idberkunjung desc";
$q1 = mysqli_query($koneksi, $sql1);
?>
<style>
    th{
        background-color: #dedede;
        color: #333333;
        font-weight: bold;
    }
    table{
        border-collapse: collapse;
        /* width: 100%; */
    }
</style>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tamu</th>
            <th>Alamat Tamu</th>
            <th>No Hp</th>
            <th>Tujuan</th>
            <th>Rumah</th>
            <th>No Hp</th>
            <th>Jam Kunjung</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1;
        while($r1=mysqli_fetch_assoc($q1)){
            ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $r1['nama_tamu'] ?></td>
                <td><?php echo $r1['alamat_tamu'] ?></td>
                <td><?php echo $r1['nohp'] ?></td>
                <td><?php echo $r1['nama'] ?></td>
                <td><?php echo $r1['no_rumah'] ?></td>
                <td><?php echo $r1['nohp1'] ?></td>
                <td><?php echo $r1['jam_kunjung'] ?></td>
                <td><?php echo $r1['status'] ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>