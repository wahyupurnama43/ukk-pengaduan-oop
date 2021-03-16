<?php

    $t = new Tanggapan();
    if (isset($_SESSION['level'])) {
        if ($_SESSION['level'] == 1 || $_SESSION['level'] == 0) {
            $data = $t->getData();
        }
    }else {
        $data = $t->getDataBy($_SESSION['user']);
    }

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
    <h3 class="card-title">Data Tanggapan</h3>
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
                <td><?php echo $d['tanggapan'] ?> </td>
                <td><?php echo date('d M Y', strtotime($d['tgl_pengaduan'])) ?></td>
                <td><?php echo $d['nama_petugas'] ?> </td>
                <td>
                    <a href="?page=detail&id=<?php echo $d['id_pengaduan'] ?>" class="btn btn-primary">Detail</a>
                </td>
              </tr>
          <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
