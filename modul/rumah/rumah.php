<?php

// uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // pengujian apakah data akan diedit / simpan baru
    if ($_GET['hal'] == 'edit') {
        //perintah edit data
        //ubah data
        $ubah = mysqli_query($koneksi, "UPDATE tbrumah SET no_rumah = '$_POST[no_rumah]',
        alamat= '$_POST[alamat]' WHERE no_rumah = '$_GET[id]'");

        if ($ubah) {
            echo "<script>
                alert('Ubah Data Sukses');
                document.location = '?halaman=rumah';
                </script>";
        }
    } else {
        //perintah simpan data baru
        // simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO tbrumah VALUES
        ('$_POST[no_rumah]', '$_POST[alamat]')");

        if ($simpan) {
            echo "<script>
            alert('Simpan Data Sukses');
            document.location = '?halaman=rumah';
            </script>";
        }
    }
}


// uji jika klik tombol edit / hapus
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        // tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbrumah where
    no_rumah = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data akan ditampung ke dalam variabel
            $vno_rumah = $data['no_rumah'];
            $valamat = $data['alamat'];
        }
    }
    else{
        $hapus = mysqli_query($koneksi, "DELETE FROM tbrumah WHERE no_rumah = '$_GET[id]'");
        if($hapus){
            echo "<script>
            alert('Hapus Data Sukses');
            document.location='?halaman=rumah';
            </script>";
        }
    }
}
?>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Data Rumah
    </div>
    <div class="card-body">
        <form method="post" action="">
            <div class="mb-3">
                <label for="no_rumah" class="form-label">No Rumah</label>
                <input type="text" class="form-control" id="no_rumah" name="no_rumah" value="<?= @$vno_rumah ?>">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= @$valamat ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger" name="bbatal">Batal</button>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Form Data Rumah
    </div>
    <div class="card-body">
        <div class="col-md-6 mx-auto">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="tcari" id="" class="form-control" placeholder="Masukkan kata kunci!">
                    <button type="submit" class="btn btn-primary" name="bcari">Cari</button>
                    <button type="reset" class="btn btn-danger" name="breset">Reset</button>
                </div>
            </form>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>No</th>
                <th>No Rumah</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php

             //uji tombol pecarian
            //jika tombol di klik
            if (isset($_POST['bcari'])) {
                $keyword = $_POST['tcari'];
                $q = "SELECT * FROM tbrumah WHERE no_rumah like '%$keyword%'
                or alamat like '%$keyword%' order by no_rumah desc";
            } else {
                $q = "SELECT * from tbrumah order by no_rumah desc";
            }

            $tampil = mysqli_query($koneksi, $q);
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['no_rumah'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td>
                        <a href="?halaman=rumah&hal=edit&id=<?= $data['no_rumah'] ?>" class="badge bg-success"> Edit </a>
                        <a href="?halaman=rumah&hal=hapus&id=<?= $data['no_rumah'] ?>" class="badge bg-danger" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">
                            Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>