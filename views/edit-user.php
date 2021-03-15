<?php
$id = $_GET['id'];

$u = new User();
$data = $u->getBy($id);

if (isset($_POST['edit'])) {
    $update = $u->update($id);
    if ($update == true) {
        echo "<script>
            alert('Data Berhasil Di Update');
            window.location.href = 'index.php?page=user';
        </script>";
    }else{
        echo "<script>
            alert('Password lama anda salah !!');
            window.location.href = 'index.php?page=edit-user&id=$id';
        </script>";
    }
}
?>
<br>
<div class="card">
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nik">Nik</label>
                <input type="text" class="form-control" id="nik" placeholder="nik" required  value="<?php echo $data['nik'] ?>" name="nik">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Nama User" required name="nama" value="<?php echo $data['nama'] ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username" required name="username" value="<?php echo $data['username'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Password lama</label>
                <input type="password" class="form-control" id="password" placeholder="Password Lama" name="password_lama">
            </div>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" class="form-control" id="password" placeholder="Password Baru" name="password_baru">
            </div>
            <div class="form-group">
                <label for="tlp">Telpon</label>
                <input type="number" class="form-control" id="tlp" placeholder="Telpon" required name="tlp" value="<?php echo $data['telp'] ?>">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
