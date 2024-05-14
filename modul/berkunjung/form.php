<?php

// uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // pengujian apakah data akan diedit / simpan baru
    if ($_GET['hal'] == 'edit') {
        //perintah edit data
        //ubah data
        $ubah = mysqli_query($koneksi, "UPDATE berkunjung SET
            idtamu = '$_POST[idtamu]',idkeluarga = '$_POST[idkeluarga]',
            status = '$_POST[status]'WHERE idberkunjung = '$_GET[id]'");

        if ($ubah) {
            echo "<script>
                alert('Ubah Data Sukses');
                document.location = '?halaman=berkunjung';
                </script>";
        }
    } else {
        //perintah simpan data baru
        // simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO berkunjung VALUES
        ('', '$_POST[idtamu]','$_POST[idkeluarga]', current_timestamp(), '$_POST[status]') ");

        if ($simpan) {
            echo "<script>
            alert('Simpan Data Sukses');
            document.location = '?halaman=berkunjung';
            </script>";
        }
    }
}


// uji jika klik tombol edit / hapus
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        // tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT berkunjung.*,
        tbltamu.nama_tamu, tbltamu.alamat_tamu, tbltamu.nohp,
         keluarga.nama, tbrumah.no_rumah, tbrumah.alamat, keluarga.nohp1 
         FROM berkunjung, tbrumah, tbltamu, keluarga
          WHERE berkunjung.idtamu = tbltamu.idtamu 
          AND keluarga.no_rumah = tbrumah.no_rumah 
          AND berkunjung.idkeluarga = keluarga.idkeluarga
            AND idberkunjung = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data akan ditampung ke dalam variabel
            $vidberkunjung = $data['idberkunjung'];
            $vidtamu = $data['idtamu'];
            $vnama_tamu = $data['nama_tamu'];
            $vidkeluarga = $data['idkeluarga'];
            $vnama = $data['nama'];
            $vstatus = $data['status'];
        }
    }
    else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM berkunjung WHERE idberkunjung = '$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses');
            document.location='?halaman=berkunjung';
            </script>";
        }
    }
}


?>

<div class="card mt-3">
    <div class="card-header bg-secondary text-white">
        Form Data Berkunjung
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="idtamu" class="form-label">Nama Tamu</label>
                        <select class="form-select form-select-sm" id="idtamu" name="idtamu">
                            <option value="<?= @$vidtamu ?>"><?= @$vnama_tamu ?></option>
                            <?php
                            $tampil = mysqli_query($koneksi, "SELECT * from tbltamu order by
                            nama_tamu asc");
                            while ($data = mysqli_fetch_array($tampil)) {
                                echo "<option value = '$data[idtamu]'> $data[nama_tamu] </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col">
                        <label for="idkeluarga" class="form-label">Nama Tujuan</label>
                        <select class="form-select form-select-sm" id="idkeluarga" name="idkeluarga" ?>">
                            <option value="<?= @$vidkeluarga ?>"><?= @$vnama ?></option>
                            <?php
                            $tampil = mysqli_query($koneksi, "SELECT * from keluarga order by
                            nama asc");
                            while ($data = mysqli_fetch_array($tampil)) {
                                echo "<option value = '$data[idkeluarga]'> $data[nama] </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select form-select-sm" id="status" name="status" ?>">
                            <option value="<?= @$vstatus?>"><?= @$vstatus?></option>
                            <option value="Menginap">Menginap</option>
                            <option value="Tidak Menginap">Tidak Menginap</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="mt-2">
                <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                <button type="reset" class="btn btn-danger" name="bbatal">Batal</button>
            </div>
        </form>
    </div>
</div>