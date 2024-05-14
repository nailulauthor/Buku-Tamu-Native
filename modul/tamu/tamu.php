<?php

// uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // pengujian apakah data akan diedit / simpan baru
    if ($_GET['hal'] == 'edit') {
        //perintah edit data
        //ubah data
        $ubah = mysqli_query($koneksi, "UPDATE tbltamu SET
            nama_tamu = '$_POST[nama_tamu]',jenis_kelamin = '$_POST[jenis_kelamin]',
             alamat_tamu = '$_POST[alamat_tamu]', nohp = '$_POST[nohp]' WHERE idtamu = '$_GET[id]'");

        if ($ubah) {
            echo "<script>
                alert('Ubah Data Sukses');
                document.location = '?halaman=tamu';
                </script>";
        }
    } else {
        //perintah simpan data baru
        // simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO tbltamu VALUES
        ('', '$_POST[nama_tamu]','$_POST[jenis_kelamin]', '$_POST[alamat_tamu]', '$_POST[nohp]') ");
       

        if ($simpan) {
            echo "<script>
            alert('Simpan Data Sukses');
            document.location = '?halaman=tamu';
            </script>";
        }
    }
}


// uji jika klik tombol edit / hapus
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        // tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbltamu where
    idtamu = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data akan ditampung ke dalam variabel
            $vnama_tamu = $data['nama_tamu'];
            $vjenis_kelamin = $data['jenis_kelamin'];
            $valamat = $data['alamat_tamu'];
            $vnohp = $data['nohp'];
        }
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM tbltamu WHERE idtamu = '$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses');
            document.location='?halaman=tamu';
            </script>";
        }
    }
}


?>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
       Form Data Tamu
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_tamu" class="form-label">Nama Tamu</label>
                <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" value="<?= @$vnama_tamu ?>">
            </div>

            <div class="mb-3">
                <label for="alamat_tamu" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat_tamu" name="alamat_tamu" value="<?= @$valamat ?>">
            </div>
            <div class="row">
                <div class="col">
                    <label for="nohp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= @$vnohp ?>">
                </div>
                <div class="col">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select form-select-sm" id="jenis_kelamin" name="jenis_kelamin" value="<?= @$vjenis_kelamin ?>">
                        <option value="<?=@$vjenis_kelamin?>"><?=@$vjenis_kelamin?></option>
                        <option value="Laki-laki">Laki laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
            <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger" name="bbatal">Batal</button>
            </div>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Data Tamu
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
        <table class="table table-bordered table-striped table-hover">
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No Hp</th>
                <th>Aksi</th>
            </tr>
            <?php
            //uji tombol pecarian
            //jika tombol di klik
            if (isset($_POST['bcari'])) {
                $keyword = $_POST['tcari'];
                $q = "SELECT * FROM tbltamu WHERE nama_tamu like '%$keyword%'
                or nohp like '%$keyword%' order by idtamu desc";
            } else {
                $q = "SELECT * from tbltamu  order by idtamu desc";
            }


            $tampil = mysqli_query($koneksi, $q);
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama_tamu'] ?></td>
                    <td><?= $data['jenis_kelamin'] ?></td>
                    <td><?= $data['alamat_tamu'] ?></td>
                    <td><?= $data['nohp'] ?></td>
                    <td>
                        <a href="?halaman=tamu&hal=edit&id=<?= $data['idtamu'] ?>" class="badge bg-success"> Edit </a>
                        <a href="?halaman=tamu&hal=hapus&id=<?= $data['idtamu'] ?>" class="badge bg-danger" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">
                            Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>