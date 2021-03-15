<?php

    $p = new Petugas();

    $data = $p->getData();

    if (isset($_POST['tambah'])) {
        $upload = $p->upload();
        if ($upload == true) {
            echo "<script>
                alert('Data Berhasil Di Tambahkan');
                window.location.href = 'index.php?page=petugas';
            </script>";
        }else{
            echo "<script>
                alert('Data Gagal Di Tambahkan');
                window.location.href = 'index.php?page=petugas';
            </script>";
        }
    }

    if (isset($_GET['d-id'])) {
        $id = $_GET['d-id'];
        $delete = $p->delete($id);
        if ($delete == true) {
            echo "<script>
                alert('Data Berhasil Di Hapus');
                window.location.href = 'index.php?page=petugas';
            </script>";
        }
    }


?>

<br>
<div class="card ">
  <div class="card-header ">
    <h3 class="card-title">Data Petugas</h3>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah Data </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Petugas</th>
        <th>Username</th>
        <th>Telpon</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
          <?php $i = 1 ?>
          <?php foreach ($data as $d): ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $d['nama_petugas'] ?> </td>
                <td><?php echo $d['username'] ?></td>
                <td><?php echo $d['telp'] ?></td>
                <td><?php echo $d['level'] ?></td>
                <td>
                    <a href="?page=edit-petugas&id=<?php echo $d['id_petugas'] ?>" class="btn btn-primary">Edit</a>
                    <a href="?page=petugas&d-id=<?php echo $d['id_petugas'] ?>" class="btn btn-danger">Hapus</a>
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
        <h4 class="modal-title">Tambah Petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama Petugas</label>
                <input type="text" class="form-control" id="nama" placeholder="Nama Petugas" required name="petugas">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username" required name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" required name="password">
            </div>
            <div class="form-group">
                <label for="tlp">Telpon</label>
                <input type="number" class="form-control" id="tlp" placeholder="Telpon" required name="tlp">
            </div>
            <div class="form-group">
                <label for="">Level</label>
                <select class="form-control" required name="level">
                    <option value="" selected disabled>Pilih Level</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
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
