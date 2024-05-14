

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Data Berkunjung Tamu
    </div>
    <div class="card-body">
        <div class="col-md-6 mx-auto">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="tcari"  id="" class="form-control" placeholder="Masukkan kata kunci!">
                    <button type="submit" class="btn btn-primary" name="bcari">Cari</button>
                    <button type="reset" class="btn btn-danger" name="breset">Reset</button>
                </div>
            </form>
        </div>
        <a href="?halaman=berkunjung&hal=tambahdata" class="btn btn-primary mb-2" >Tambah Data</a>
        <a href="http://localhost/tugas/modul/berkunjung/print.php" class="btn btn-warning mb-2 text-white"><i class="fa-solid fa-download"></i>Download</a>
        <table class="table table-bordered table-striped table-hover">
            <tr class="text-center">
                <th>No</th>
                <th>Tamu</th>
                <th>Alamat Tamu</th>
                <th>No Hp</th>
                <th>Tujuan</th>
                <th>Rumah</th>
                <th>No HP</th>
                <th>Jam Kunjung</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php
            //uji tombol pecarian
            //jika tombol di klik
            if (isset($_POST['bcari'])) {
                $keyword = $_POST['tcari'];
                $q = "SELECT berkunjung.idberkunjung, berkunjung.jam_kunjung, berkunjung.status,
                tbltamu.nama_tamu, tbltamu.alamat_tamu, tbltamu.nohp,
                keluarga.nama, tbrumah.no_rumah, tbrumah.alamat, keluarga.nohp1 
                FROM berkunjung, tbrumah, tbltamu, keluarga
                WHERE berkunjung.idtamu = tbltamu.idtamu 
                AND keluarga.no_rumah = tbrumah.no_rumah 
                AND berkunjung.idkeluarga = keluarga.idkeluarga
                AND (tbltamu.nama_tamu LIKE '%$keyword%' 
                OR keluarga.nama LIKE '%$keyword%')
                ORDER BY tbltamu.nama_tamu ASC";
         
                
            } else {
                $q = "SELECT berkunjung.*,
                tbltamu.nama_tamu, tbltamu.alamat_tamu, tbltamu.nohp,
                 keluarga.nama, tbrumah.no_rumah, tbrumah.alamat, keluarga.nohp1 
                 FROM berkunjung, tbrumah, tbltamu, keluarga
                  WHERE berkunjung.idtamu = tbltamu.idtamu 
                  AND keluarga.no_rumah = tbrumah.no_rumah 
                  AND berkunjung.idkeluarga = keluarga.idkeluarga
                  order by idberkunjung desc";
            }


            $tampil = mysqli_query($koneksi, $q);
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $data['nama_tamu'] ?></td>
                    <td class="col-2"><?= $data['alamat_tamu'] ?></td>
                    <td class="col-1"><?= $data['nohp'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['no_rumah']?></td>
                    <td class="col-1"><?= $data['nohp1'] ?></td>
                    <td class="col-2"><?= $data['jam_kunjung'] ?></td>
                    <td ><?= $data['status'] ?></td>
                    <td class="text-center">
                        <a href="?halaman=berkunjung&hal=edit&id=<?= $data['idberkunjung'] ?>" class="badge bg-success"> Edit </a>
                        <a href="?halaman=berkunjung&hal=hapus&id=<?= $data['idberkunjung'] ?>" class="badge bg-danger" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">
                            Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>