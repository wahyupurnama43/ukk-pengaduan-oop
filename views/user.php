<?php

    $u = new User();

    $data = $u->getData();

    if (isset($_POST['tambah'])) {
        $upload = $u->upload();
        if ($upload == true) {
            echo "<script>
                alert('Data Berhasil Di Tambahkan');
                window.location.href = 'index.php?page=user';
            </script>";
        }else{
            echo "<script>
                alert('Nik Sudah Terdaftar');
                window.location.href = 'index.php?page=user';
            </script>";
        }
    }

    if (isset($_GET['d-id'])) {
        $id = $_GET['d-id'];
        $delete = $u->delete($id);
        if ($delete == true) {
            echo "<script>
                alert('Data Berhasil Di Hapus');
                window.location.href = 'index.php?page=user';
            </script>";
        }
    }


?>
<br>
<div class="card ">
  <div class="card-header ">
    <h3 class="card-title">Data User</h3>
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
        <th>Nama User</th>
        <th>Username</th>
        <th>Nik</th>
        <th>Telpon</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
          <?php $i = 1 ?>
          <?php foreach ($data as $d): ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $d['nama'] ?> </td>
                <td><?php echo $d['username'] ?></td>
                <td><?php echo $d['nik'] ?></td>
                <td><?php echo $d['telp'] ?></td>
                <td>
                    <a href="?page=edit-user&id=<?php echo $d['nik'] ?>" class="btn btn-primary" >Edit</a>
                    <a href="?page=user&d-id=<?php echo $d['nik'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Di Hapus')">Hapus</a>
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
        <h4 class="modal-title">Tambah User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nik">Nik</label>
                <input type="text" class="form-control" id="nik" placeholder="nik" required name="nik">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Nama User" required name="nama">
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
