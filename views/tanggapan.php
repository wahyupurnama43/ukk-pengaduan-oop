<?php

    $t = new Tanggapan();
    $data = $t->getData();

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
        <th>Tanggapan</th>
        <th>Tanggal</th>
        <th>Petugas</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
          <?php $i = 1 ?>
          <?php foreach ($data as $d): ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $d['nama'] ?> </td>
                <td><?php echo $d['nama'] ?> </td>
                <td><?php echo $d['tgl_pengaduan'] ?></td>
                <td><?php echo $d['nama'] ?> </td>
                <td>

                </td>
              </tr>
          <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
