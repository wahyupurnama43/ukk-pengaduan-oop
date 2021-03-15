<?php

    $pe = new Pengaduan();
    $data = $pe->getData();
    $u = new User();
    $dataU = $u->getByUser($_SESSION['user']);
    if (isset($_POST['tambah'])) {
        $upload = $pe->upload();
        if ($upload == true) {
            echo "<script>
                alert('Data Berhasil Di Tambahkan');
                window.location.href = 'index.php?page=pengaduan';
            </script>";
        }else{
            echo "<script>
                alert('Nik Sudah Terdaftar');
                window.location.href = 'index.php?page=pengaduan';
            </script>";
        }
    }
    //
    if (isset($_GET['d-id'])) {
        $id = $_GET['d-id'];
        $delete = $pe->delete($id);
        if ($delete == true) {
            echo "<script>
                alert('Data Berhasil Di Hapus');
                window.location.href = 'index.php?page=pengaduan';
            </script>";
        }
    }


?>
<br>
<div class="card ">
  <div class="card-header ">
    <h3 class="card-title">Data Pengaduan</h3>
    <div class="d-flex justify-content-end">
        <?php if (isset($_SESSION['masyarakat']) && $_SESSION['masyarakat'] == true): ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah Data </button>
        <?php endif; ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Pengaduan</th>
        <th>Laporan</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
          <?php $i = 1 ?>
          <?php foreach ($data as $d): ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $d['nama'] ?> </td>
                <td><?php echo  substr( $d['isi_laporan'] ,0,30)?></td>
                <td><?php echo $d['tgl_pengaduan'] ?></td>
                <td>
                    <?php if ($d['status'] == 'proses'): ?>

                    <div class="bg-warning pb-1" style="border-radius:30px">
                        <?php echo $d['status'] ?>
                    </div>
                    <?php else: ?>
                        <div class="text-white bg-success pb-1" style="border-radius:30px">
                            <?php echo $d['status'] ?>
                        </div>
                <?php endif; ?>

                </td>
                <td>
                    <?php if (isset($_SESSION['level'])): ?>
                        <a href="?page=detail&id=<?php echo $d['id_pengaduan'] ?>" class="btn btn-primary">Detail</a>
                    <?php else: ?>
                    <?php if ($d['status'] == 'proses'): ?>
                        <a href="?page=edit-user&id=<?php echo $d['id_pengaduan'] ?>" class="btn btn-primary" >Edit</a>
                    <?php endif; ?>
                    <a href="?page=pengaduan&d-id=<?php echo $d['id_pengaduan'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Di Hapus')">Hapus</a>
                <?php endif; ?>

                </td>
              </tr>
          <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengaduan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nik">Nik</label>
                <input type="hidden" name="nik" value="<?php echo $dataU['nik'] ?>">
                <input type="text" class="form-control" id="nik" placeholder="nik" disabled  value="<?php echo $dataU['nik'] ?>">
            </div>
            <div class="form-group">
                <label for="laporan">Laporan</label>
                <textarea name="laporan" rows="4" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label for="foto">Foto Pengaduan</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="foto" class="custom-file-input" id="foto" required>
                  <label class="custom-file-label" for="foto">Choose file</label>
                </div>
              </div>
            </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" name="tambah" class="btn btn-primary">Save changes</button>
      </div>
  </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
