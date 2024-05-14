<?php

// uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // pengujian apakah data akan diedit / simpan baru
    if ($_GET['hal'] == 'edit') {
        //perintah edit data
        //ubah data
        $ubah = mysqli_query($koneksi, "UPDATE keluarga SET
            no_rumah = '$_POST[no_rumah]', nama = '$_POST[nama]',
            panggilan = '$_POST[panggilan]',nohp1 = '$_POST[nohp]', jenis_kelamin= '$_POST[jenis_kelamin]'
             WHERE idkeluarga = '$_GET[id]'");

        if ($ubah) {
            echo "<script>
                alert('Ubah Data Sukses');
                document.location = '?halaman=keluarga';
                </script>";
        }
    } else {
        //perintah simpan data baru
        // simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO keluarga VALUES
        ('', '$_POST[no_rumah]', '$_POST[nama]', 
        '$_POST[panggilan]','$_POST[nohp]', '$_POST[jenis_kelamin]') ");

        if ($simpan) {
            echo "<script>
            alert('Simpan Data Sukses');
            document.location = '?halaman=keluarga';
            </script>";
        }
    }
}


// uji jika klik tombol edit / hapus
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        // tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM keluarga where idkeluarga = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data akan ditampung ke dalam variabel
            $vno_rumah = $data['no_rumah'];
            $vnama = $data['nama'];
            $vpanggilan = $data['panggilan'];
            $vnohp = $data['nohp1'];
            $vjenis_kelamin = $data['jenis_kelamin'];
        }
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM keluarga WHERE idkeluarga = '$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses');
            document.location='?halaman=keluarga';
            </script>";
        }
    }
}


?>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Form Data Keluarga
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="no_rumah" class="form-label">No Rumah</label>
                        <select class="form-select form-select-sm" id="no_rumah" name="no_rumah">
                            <option value="<?= @$vno_rumah ?>"><?= @$vno_rumah ?></option>
                            <?php
                            $tampil = mysqli_query($koneksi, "SELECT * from tbrumah order by
                            no_rumah asc");
                            while ($data = mysqli_fetch_array($tampil)) {
                                echo "<option value = '$data[no_rumah]'> $data[no_rumah] </option>";
                            }
                            ?>
                        </select>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= @$vnama ?>">
            </div>
            <div class="mb-3">
                <label for="panggilan" class="form-label">Panggilan</label>
                <input type="text" class="form-control" id="panggilan" name="panggilan" value="<?= @$vpanggilan ?>">
            </div>
            <div class="row">
                <div class="col">
                    <label for="nohp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= @$vnohp ?>">
                </div>
                <div class="col mb-3">
                    <label for="jenis_kelamin" class="form-label">jenis_kelamin</label>
                    <select class="form-select form-select-sm" id="jenis_kelamin" name="jenis_kelamin" value="<?= @$vjenis_kelamin ?>">
                    <option value="<?=@$vjenis_kelamin?>"><?=@$vjenis_kelamin?></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger" name="bbatal">Batal</button>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Form Data Keluarga
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
                <th>No Rumah</th>
                <th>Nama</th>
                <th>Panggilan</th>
                <th>No Hp</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
            <?php
            //uji tombol pecarian
            //jika tombol di klik
            if (isset($_POST['bcari'])) {
                $keyword = $_POST['tcari'];
                $q = "SELECT * FROM keluarga WHERE no_rumah like '%$keyword%'
                or nohp1 like '%$keyword%' or panggilan like '%$keyword%'
                or nama like '%$keyword%' order by no_rumah desc";
            } else {
                $q = "SELECT * from keluarga  order by no_rumah desc";
            }


            $tampil = mysqli_query($koneksi, $q);
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $data['no_rumah'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['panggilan'] ?></td>
                    <td><?= $data['nohp1'] ?></td>
                    <td class="col-1"><?= $data['jenis_kelamin'] ?></td>
                    <td>
                        <a href="?halaman=keluarga&hal=edit&id=<?= $data['idkeluarga'] ?>" class="badge bg-success"> Edit </a>
                        <a href="?halaman=keluarga&hal=hapus&id=<?= $data['idkeluarga'] ?>" class="badge bg-danger" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">
                            Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>