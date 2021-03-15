<?php

    $id = $_GET['id'];
    $pe = new Pengaduan();
    $data = $pe->detail($id);
    $tanggapan = $pe->tanggapan($id);
    if ($tanggapan == null) {
        $tanggap = '';
    }else{
        $tanggap = $tanggapan['tanggapan'];
    }
    if (isset($_POST['tanggap'])) {
        $upload = $pe->tanggap($id,$_POST,$_SESSION['user']);

        if ($upload == true) {
            echo "
                <script>
                    alert('Data Berhasil DiTambahkan');
                    document.location.href = '?page=pengaduan';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data Gagal DiTambahkan');
                    document.location.href = '?page=pengaduan';
                </script>
            ";
        }
    }
?>
<br>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5>Detail Pengadu</h5>
                <hr>
                <div class="text-center">
                    <img src="../assets/gambar/<?php echo $data['foto'] ?>" alt="" width="70%">
                </div>
                <br>
                <table>
                    <tr>
                        <td width="60%">Nik</td>
                        <td>: &nbsp;&nbsp; <?php echo $data['nik'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: &nbsp;&nbsp; <?php echo $data['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Telpon</td>
                        <td>: &nbsp;&nbsp; <?php echo $data['telp'] ?></td>
                    </tr>

                    <tr>
                        <td>Tanggal Laporan</td>
                        <td>: &nbsp;&nbsp; <?php echo date('d M Y',strtotime($data['tgl_pengaduan'])) ?></td>
                    </tr>
                    <tr>
                        <td>Laporan</td>
                        <td>: &nbsp;&nbsp; <?php echo $data['isi_laporan'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5>Tanggapan</h5>
                <hr>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="petugas">Username Petugas</label>
                        <input type="text" class="form-control" id="petugas" placeholder="Username Petugas" value="<?= ($tanggapan == '') ?   $_SESSION['user'] : $tanggapan['nama_petugas'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea name="tanggapan" rows="4" class="form-control" required <?php echo ($tanggap !== '') ? 'disabled' : '' ?>><?php echo ($tanggap !== '') ? $tanggap : '' ?></textarea>
                    </div>
                    <?php if ($tanggap === ''): ?>
                        <button type="submit" name="tanggap" class="btn btn-primary">Kirim</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

</div>
